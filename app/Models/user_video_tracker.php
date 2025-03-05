<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_video_tracker extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function course_attachments(){
        return $this->hasMany(courseAttachment::class);
    }
}
