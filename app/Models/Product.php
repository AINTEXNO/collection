<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function collection(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function style(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Style::class);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function color(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function promotions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

//    public function getPriceAttribute($value): string
//    {
//        return number_format($value, 0, '', '.');
//    }

    public function setCodeAttribute()
    {
        $this->attributes['code'] = (string)rand(1000000, 9999999);
    }
}
