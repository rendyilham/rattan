<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public const STATUSES = [
        'Menunggu Pembayaran',
        'Pembayaran Dikonfirmasi',
        'Diproses',
        'Dikirim',
        'Selesai',
        'Dibatalkan',
    ];

    // Tambahkan order_id ke dalam fillable
    protected $fillable = ['order_id', 'user_id', 'total_price', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
