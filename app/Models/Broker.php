<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'logo',
        'subscription_tier',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Example: if you later add subscription records
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}