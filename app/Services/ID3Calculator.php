<?php

namespace App\Services;

class ID3Calculator
{
    private array $data;
    private array $attributes;
    private string $targetAttribute;

    public function __construct(array $data, array $attributes, string $targetAttribute)
    {
        $this->data = $data;
        $this->attributes = $attributes;
        $this->targetAttribute = $targetAttribute;
    }

    public function calculate(): array
    {
        $gainResults = [];
        $totalEntropy = $this->entropy($this->data);

        foreach ($this->attributes as $attribute) {
            if ($attribute !== $this->targetAttribute) {
                $gainResults[$attribute] = [
                    'entropy' => $totalEntropy,
                    'gain' => $this->gain($this->data, $attribute)
                ];
            }
        }

        $tree = $this->buildTree($this->data, $this->attributes);

        return [
            'tree' => $tree,
            'gains' => $gainResults,
        ];
    }

    private function entropy(array $subset): float
    {
        $total = count($subset);
        if ($total === 0) return 0;

        $labelCounts = array_count_values(array_column($subset, $this->targetAttribute));
        $entropy = 0.0;

        foreach ($labelCounts as $count) {
            $probability = $count / $total;
            $entropy -= $probability * log($probability, 2);
        }

        return round($entropy, 4);
    }

    private function gain(array $subset, string $attribute): float
    {
        $total = count($subset);
        $attributeValues = array_unique(array_column($subset, $attribute));
        $weightedEntropy = 0.0;

        foreach ($attributeValues as $value) {
            $subsetValue = array_filter($subset, fn($row) => $row[$attribute] === $value);
            $subsetCount = count($subsetValue);
            $entropy = $this->entropy($subsetValue);
            $weightedEntropy += ($subsetCount / $total) * $entropy;
        }

        $totalEntropy = $this->entropy($subset);
        return round($totalEntropy - $weightedEntropy, 4);
    }

    private function buildTree(array $data, array $attributes): array
    {
        $labels = array_column($data, $this->targetAttribute);

        // Basis 1: jika semua label sama
        if (count(array_unique($labels)) === 1) {
            return ['label' => $labels[0]]; // FIX: return array, bukan string
        }

        // Basis 2: tidak ada atribut yang tersisa selain target
        if (count($attributes) === 1) {
            return ['label' => $this->majorityLabel($labels)]; // FIX
        }

        // Hitung gain setiap atribut
        $gains = [];
        foreach ($attributes as $attribute) {
            if ($attribute !== $this->targetAttribute) {
                $gains[$attribute] = $this->gain($data, $attribute);
            }
        }

        // Pilih atribut terbaik
        arsort($gains);
        $bestAttribute = array_key_first($gains);
        $tree = [$bestAttribute => []];

        foreach (array_unique(array_column($data, $bestAttribute)) as $value) {
            $subset = array_filter($data, fn($row) => $row[$bestAttribute] === $value);
            $subset = array_values($subset);

            if (empty($subset)) {
                $tree[$bestAttribute][$value] = ['label' => $this->majorityLabel($labels)];
            } else {
                $remainingAttributes = array_filter($attributes, fn($attr) => $attr !== $bestAttribute);
                $tree[$bestAttribute][$value] = $this->buildTree($subset, $remainingAttributes);
            }
        }

        return $tree;
    }

    

    private function majorityLabel(array $labels): string
    {
        $counts = array_count_values($labels);
        arsort($counts);
        return array_key_first($counts);
    }

    public $gains = []; // untuk menyimpan gain per atribut




}
