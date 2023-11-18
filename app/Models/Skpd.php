<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skpd extends Model
{
    use HasFactory;

    protected $fillable = [
        'dinas',
        'alamat',
        'kode_pos',
        'user_id'
    ];

    protected static function booted()
    {
        static::deleting(function ($skpd) {
            // Sebelum menghapus SKPD, setel kunci asing 'skpd_id' menjadi null pada model User yang terkait
            $skpd->user->update(['skpd_id' => null]);
        });
    }
    public function sp2d()
    {
        return $this->hasMany(Sp2d::class);
    }
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
