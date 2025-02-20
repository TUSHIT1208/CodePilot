<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestOption extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function testquestion()
    {
        return $this->belongsTo(TestQuestion::class);
    }
}