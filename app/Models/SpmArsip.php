<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpmArsip extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'nomor_arsip',
        'tanggal',
        'path',
        'jenis',
        'keterangan',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
