<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'jumlah', 'bunga', 'jangka_waktu', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

