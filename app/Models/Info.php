<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $fillable = ['title', 'description', 'icon', 'sort_order', 'status'];

    protected $casts = ['status' => 'boolean', 'sort_order' => 'integer'];

    public const ICONS = [
        'la-chalkboard-teacher' => 'Expert teachers',
        'la-comments' => 'Communication',
        'la-certificate' => 'Certificates',
        'la-clock' => 'Flexible learning',
        'la-laptop' => 'Online learning',
        'la-book-open' => 'Courses and resources',
        'la-graduation-cap' => 'Education',
        'la-lightbulb' => 'Ideas and skills',
        'la-users' => 'Community',
        'la-headset' => 'Support',
    ];
}
