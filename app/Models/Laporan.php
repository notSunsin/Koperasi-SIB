<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'user_id',
        'uraian',
        'debit',
        'kredit',
        'saldo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
