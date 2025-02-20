<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class video_code extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function video(){
        return $this->belongsTo(video_code::class);
    }
}
