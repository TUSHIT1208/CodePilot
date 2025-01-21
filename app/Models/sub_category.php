<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_category extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'name', 'description'];
    protected $guarded=[];
    public function category()
    {
        return $this->belongsTo(category::class);
    }
}
