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
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        // Keep portraits uploaded with the previous storage method accessible.
        return str_starts_with($this->image, 'testimonials/')
            ? \Illuminate\Support\Facades\Storage::disk('public')->url($this->image)
            : asset($this->image);
    }
}
