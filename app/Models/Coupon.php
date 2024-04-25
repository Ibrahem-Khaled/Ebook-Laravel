<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'code', 'discount'];


    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
