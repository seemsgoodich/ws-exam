<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'item_id', 'count'
    ];

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function toArray() {
        return [
          'id' => $this->id,
          'count' => $this->count,
          'item' => $this->item,
          'price' => $this->item->price * $this->count,
        ];
    }
}
