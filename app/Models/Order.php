<?php

namespace App\Models;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'order_date',
        'status',
        'delivery_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function address()
    {
        return $this->belongsTo(Address::class, 'delivery_id', 'id');
    }

    public function bill()
    {
        return $this->hasOne(Bill::class, 'order_id', 'id');
    }
}
