<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'price', 'available', 'category_id', 'model_type', 'model_year', 'model_country'
    ];
}
