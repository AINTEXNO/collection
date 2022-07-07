<?php

namespace App\Models;

use App\Traits\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function setAliasAttribute($value)
    {
        $this->attributes['alias'] = Helpers::transliteration($value);
    }
}
