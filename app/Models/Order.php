<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'pickup_address', 'destination_address',
        'distance_Km', 'price', 'vehicle', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
