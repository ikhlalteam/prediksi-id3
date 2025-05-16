<?php

namespace App\Services;

class ID3Calculator
{
    protected $data;
    protected $attributes;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->attributes = array_keys($data[0]);
        unset($this->attributes[array_search('hasil_prediksi', $this->attributes)]);
    }

    public function calculate(): array
    {
        return $this->buildTree($this->data, $this->attributes);
    }

    protected function buildTree(array $data, array $attributes)
    {
        $labels = array_column($data, 'hasil_prediksi');
        if (count(array_unique($labels)) === 1) {
            return $labels[0];
        }

        if (empty($attributes)) {
            return $this->mostCommonLabel($labels);
        }

        $bestAttr = $this->chooseBestAttribute($data, $attributes);
        $tree = [$bestAttr => []];

        foreach ($this->getUniqueValues($data, $bestAttr) as $val) {
            $subset = array_filter($data, fn($row) => $row[$bestAttr] == $val);
            if (empty($subset)) {
                $tree[$bestAttr][$val] = $this->mostCommonLabel($labels);
            } else {
                $remainingAttrs = array_diff($attributes, [$bestAttr]);
                $tree[$bestAttr][$val] = $this->buildTree(array_values($subset), $remainingAttrs);
            }
        }

        return $tree;
    }

    protected function chooseBestAttribute(array $data, array $attributes)
    {
        $baseEntropy = $this->entropy(array_column($data, 'hasil_prediksi'));
        $bestGain = -INF;
        $bestAttr = null;

        foreach ($attributes as $attr) {
            $gain = $this->informationGain($data, $attr, $baseEntropy);
            if ($gain > $bestGain) {
                $bestGain = $gain;
                $bestAttr = $attr;
            }
        }

        return $bestAttr;
    }

    protected function entropy(array $labels)
    {
        $total = count($labels);
        $counts = array_count_values($labels);
        $entropy = 0.0;

        foreach ($counts as $count) {
            $p = $count / $total;
            $entropy -= $p * log($p, 2);
        }

        return $entropy;
    }

    protected function informationGain(array $data, string $attribute, float $baseEntropy)
    {
        $values = $this->getUniqueValues($data, $attribute);
        $subsetEntropy = 0.0;

        foreach ($values as $value) {
            $subset = array_filter($data, fn($row) => $row[$attribute] == $value);
            $p = count($subset) / count($data);
            $subsetLabels = array_column($subset, 'hasil_prediksi');
            $subsetEntropy += $p * $this->entropy($subsetLabels);
        }

        return $baseEntropy - $subsetEntropy;
    }

    protected function mostCommonLabel(array $labels)
    {
        $counts = array_count_values($labels);
        arsort($counts);
        return array_key_first($counts);
    }

    protected function getUniqueValues(array $data, string $attribute): array
    {
        return array_values(array_unique(array_column($data, $attribute)));
    }
}
