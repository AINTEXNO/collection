<?php

namespace App\Models;

use App\Traits\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function shops(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Shop::class);
    }

    public function setAliasAttribute($value)
    {
        $this->attributes['alias'] = Helpers::transliteration($value);
    }
}
