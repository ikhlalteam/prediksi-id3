<?php 
 namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuleHistory extends Model
{
    protected $table = 'rule_histories';
    protected $casts = [
        'entropy_gain' => 'array',
        'rules_json' => 'array',
        'decision_tree' => 'array',
    ];
}
