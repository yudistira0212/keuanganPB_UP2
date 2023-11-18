<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ttd extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nip',
        'url_ttd'
    ];

    public function sp2d()
    {
        return $this->hasMany(Sp2d::class);
    }
}
