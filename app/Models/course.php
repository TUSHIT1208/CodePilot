<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(Sub_Category::class);
    }

    public function test()
    {
        return $this->hasMany(test::class);
    }

    public function courseattachment(){
        return $this->hasMany(courseAttachment::class);
    }

    public function cart(){
        return $this->hasMany(cart::class);
    }

    public function userCourse(){
        return $this->hasMany(user_course::class);
    }
    public function review(){
        return $this->hasMany(review::class,'course_id');
    }
    public function order_item()
    {
        return $this->hasMany(Order_item::class, 'course_id');
    }
    public function latestReview()
    {
        return $this->hasOne(Review::class, 'course_id')->latest();
    }

    
}
