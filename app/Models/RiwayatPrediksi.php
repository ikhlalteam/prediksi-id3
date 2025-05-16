<?php

// app/Models/RiwayatPrediksi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class RiwayatPrediksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'luas_lahan',
        'jenis_lahan',
        'jenis_bibit',
        'cuaca',
        'lama_bertani',
        'hasil_prediksi',
    ];
}
