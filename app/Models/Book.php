<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    use HasFactory;
    protected $fillable = ['title','author','collection','isbn','publish_date','pages_number','location','content','category_id'];
}
