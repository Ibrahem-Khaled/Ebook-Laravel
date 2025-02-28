<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $appends = ['is_user_subscribed'];
    protected $fillable = [
        'title',
        'description',
        'icon',
        'price',
        'duration',
        'is_active',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_subscriptions', 'subscription_id', 'user_id')->withPivot('id', 'expiry_date');

    }
    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'subscription_id');
    }


    //this accessors methods 
    public function getIsUserSubscribedAttribute()
    {
        if (!auth()->guard('api')->check()) {
            return true;
        }
        return $this->users()->where('user_id', auth()->guard('api')->user()->id)->exists();
    }
}
