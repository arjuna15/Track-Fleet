<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VendorPartner extends Model
{
    protected $guarded = [];

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
