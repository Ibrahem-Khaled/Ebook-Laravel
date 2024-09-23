<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookWatchInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'view_count',
        'reader_count',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
