<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'images',
        'files',
        'status',
        'user_id',
    ];

    protected $casts = [
        'images' => 'array',
        'files' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
