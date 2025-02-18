<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class test extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'test_title', 'passing_mark', 'created_at'];

    public $timestamps = false; // Disable 'updated_at' and 'created_at' management

    public function course()
    {
        return $this->belongsTo(course::class);
    }
}