<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanSp2d extends Model
{
    use HasFactory;

    protected $fillable = [
        "path",
        "sp2d_id",
        "status",
        'pesan',
        "tanggal"
    ];

    public function sp2d()
    {
        return $this->belongsTo(Sp2d::class);
    }
}
