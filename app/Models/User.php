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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

}
