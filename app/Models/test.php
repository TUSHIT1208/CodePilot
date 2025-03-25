<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class test extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false; // Disable 'updated_at' and 'created_at' management

    public function course()
    {
        return $this->belongsTo(course::class);
    }

    public function testquestion()
    {
        return $this->hasMany(TestQuestion::class, 'test_id');
    }
    public function testoption()
    {
        return $this->hasMany(TestOption::class, 'question_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }


}