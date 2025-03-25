<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_course extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(course::class,'course_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function paymentTransaction()
    {
        return $this->hasOneThrough(PaymentTransaction::class, Order::class, 'user_id', 'order_id', 'user_id', 'id');
    }
}
