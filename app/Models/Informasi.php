<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $fillable = ['no_rekening', 'jumlah', "keterangan", 'sp2d_id'];



    public function sp2d()
    {
        return $this->belongsTo(Sp2d::class);
    }
}
