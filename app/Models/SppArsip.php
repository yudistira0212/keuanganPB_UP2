<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppArsip extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'path',
        'nomor_arsip',
        'tanggal',
        'jenis',
        'keterangan',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
