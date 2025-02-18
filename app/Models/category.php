<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            $category->sub_categories()->delete();
        });
    }
    
    public function sub_categories()
    {
        return $this->hasMany(sub_category::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
