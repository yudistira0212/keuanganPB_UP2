<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keperluan extends Model
{
    use HasFactory; // Sesuaikan dengan nama tabel Anda

    protected $fillable = [
        'kode_rekening', 'uraian', 'jumlah', 'sp2d_id'
    ];

    // protected function data(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => json_decode($value, true),
    //         set: fn ($value) => json_encode($value),
    //     );
    // }

    // Kolom yang dapat diisi secara massal

    // Nonaktifkan timestamps (created_at dan updated_at) jika tabel Anda tidak memiliki kolom tersebut
    public $timestamps = true;

    public function sp2d()
    {
        return $this->belongsTo(Sp2d::class);
    }
}
