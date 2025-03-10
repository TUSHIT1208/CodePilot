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
}
