<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public const STATUSES = ['new', 'in_progress', 'resolved'];

    protected $fillable = ['name', 'email', 'subject', 'message', 'status', 'reply', 'replied_at'];

    protected function casts(): array
    {
        return ['replied_at' => 'datetime'];
    }
}
