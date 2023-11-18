<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Casts\Attribute;
use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sp2d extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_spm',
        'tgl_sp2d',
        'no_surat',
        'no_rek_keuangan',
        'bank_pos_keuangan',
        'tahun_anggaran',
        'bank_pos',
        'rekening',
        'jumlah_uang',
        'kepada',
        'npwp',
        'uraian_keperluan',
        'uraian_potongan',
        'keperluan',
        'user_id',
        'ttd_id',
        'skpd_id',
        'is_delete',
    ];

    // protected $casts = [
    //     'uraian_keperluan' => 'json',
    //     'uraian_potongan' => 'json',
    // ];

    // protected function uraianKeperluan(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => json_decode($value, true),
    //         set: fn ($value) => json_encode($value),
    //     );
    // }

    // protected function uraianPotongan(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => json_decode($value, true),
    //         set: fn ($value) => json_encode($value),
    //     );
    // }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keperluann()
    {
        return $this->hasMany(Keperluan::class);
    }
    public function potongan()
    {
        return $this->hasMany(Potongan::class);
    }
    public function informasi()
    {
        return $this->hasMany(Informasi::class);
    }
    public function ttd()
    {
        return $this->belongsTo(Ttd::class);
    }
    public function skpd()
    {
        return $this->belongsTo(Skpd::class);
    }
    public function permintaanSp2d()
    {
        return $this->hasOne(PermintaanSp2d::class);
    }
}
