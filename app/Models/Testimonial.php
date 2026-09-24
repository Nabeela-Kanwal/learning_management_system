<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name', 'role', 'quote', 'rating', 'image', 'sort_order', 'status'];

    protected function casts(): array
    {
        return ['status' => 'boolean', 'rating' => 'integer', 'sort_order' => 'integer'];
    }
}
