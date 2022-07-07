<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getDurationAttribute(): string
    {
        return "с " . date("d.m", strtotime($this->start_date)) . " до " . date("d.m", strtotime($this->end_date));
    }

    public function getStatusAttribute($value): string
    {
        return $value ? 'Активна' : 'Скрыта';
    }
}
