<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courseAttachment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function course(){
        return $this->belongsTo(course::class,'course_id');
    }

    public function user_video_tracker()
    {
        return $this->belongsTo(user_video_tracker::class);
    }
}
