<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $guarded = [];

    // relations
    public function books()
    {
        return $this->hasMany(Book::class, 'publisher_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_author_publishers', 'publisher_id', 'user_id');
    }
    
}
