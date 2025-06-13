<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Facades\File;

class Book extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['is_user_subscribed'];
    protected $casts = [
        'book_publication_date' => 'date',
    ];
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'book_id');
    }
    public function userBooks()
    {
        return $this->belongsToMany(User::class, 'user_books');
    }
    public function userCart()
    {
        return $this->hasMany(UserCarts::class, 'book_id');
    }

    public function scopeSearch($query, $term)
    {
        return $query->whereHas('author', function ($query) use ($term) {
            $query->where('author_name', 'like', '%' . $term . '%');
        })->orWhereHas('publisher', function ($query) use ($term) {
            $query->where('publisher_name', 'like', '%' . $term . '%');
        })->orWhere('book_title', 'like', '%' . $term . '%')
            ->orWhere('book_description', 'like', '%' . $term . '%');
    }

    public function userFav()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
    protected static function boot(): void
    {
        parent::boot();

        // Escuchamos el evento "deleting" del modelo Book
        static::deleting(function ($book) {

            // Delete the image associated with the book
            $imagePath = public_path($book->book_image_url);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        });
    }


    public function bookRatings()
    {
        return $this->hasMany(BookRating::class, 'book_id');
    }

    public function bookInfo()
    {
        return $this->hasMany(BookInfo::class, 'book_id');
    }

    public function bookWatchInfo()
    {
        return $this->hasOne(BookWatchInfo::class, 'book_id');
    }

    public function userBookReadHistories()
    {
        return $this->belongsToMany(User::class, 'user_book_read_histories', 'book_id', 'user_id')
            ->withPivot('id', 'page');
    }


    // this accessors methods
    public function getIsUserSubscribedAttribute()
    {
        if (!auth()->guard('api')->check()) {
            return false;
        }
        return auth()->guard('api')->user()->subscription()->exists();
    }
}
