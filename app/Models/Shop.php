<?php

namespace App\Models;

use App\Traits\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function getPhoneNumberAttribute($value): string
    {
        return Helpers::phone($value);
    }
}
