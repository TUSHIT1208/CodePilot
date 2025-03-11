<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class test_result extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function test()
    {
        return $this->belongsTo(test::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function test_result_answer()  {
        return $this->hasMany(test_result_answer::class);
    }
}
