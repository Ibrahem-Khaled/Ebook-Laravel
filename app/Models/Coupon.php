<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'subscription_id', 'code', 'discount', 'user_id', 'is_used', 'type'];


    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
