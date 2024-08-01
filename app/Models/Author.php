<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    protected $guarded = [];

    // relations

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_author_publishers', 'author_id', 'user_id');
    }

}
