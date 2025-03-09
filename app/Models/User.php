<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $appends = ['is_user_subscribed'];
    protected $fillable = [
        'name',
        'email',
        'password',
        'fcm_token'
        'role_id',
    ];
    protected $hidden = [
        'password',
        'remember_token',
        'role_id'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'user_books');
    }
    public function carts()
    {
        return $this->hasMany(UserCarts::class);
    }
    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'user_id');
    }
    public function contactus()
    {
        return $this->hasMany(ContactUs::class, 'user_id');
    }

    public function bookFav()
    {
        return $this->belongsToMany(Book::class, 'favorites');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function userRatings()
    {
        return $this->hasMany(BookRating::class, 'user_id');
    }

    public function author()
    {
        return $this->belongsToMany(Author::class, 'user_author_publishers', 'user_id', 'author_id')->withPivot('id');
    }

    public function publisher()
    {
        return $this->belongsToMany(Publisher::class, 'user_author_publishers', 'user_id', 'publisher_id')->withPivot('id');
    }

    public function subscription()
    {
        return $this->belongsToMany(Subscription::class, 'user_subscriptions', 'user_id', 'subscription_id')->withPivot('id', 'expiry_date');
    }

    public function bookReadHistory()
    {
        return $this->belongsToMany(Book::class, 'user_book_read_histories', 'user_id', 'book_id')
            ->withPivot('id', 'page');
    }


    //this accessors methods
    public function getIsUserSubscribedAttribute()
    {
        if (!auth()->guard('api')->check()) {
            return false;
        }
        return auth()->guard('api')->user()->subscription()->exists();
    }



    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

}
