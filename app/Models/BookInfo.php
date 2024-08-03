<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookInfo extends Model
{
    use HasFactory;
    protected $fillable = ['book_id', 'paper_url', 'author_id'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
