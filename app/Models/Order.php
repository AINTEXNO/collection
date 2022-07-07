<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'id');
    }

    public function getCreatedAttribute()
    {
        return date_format($this->created_at, "d F, Y");
    }

    public function getTotalAttribute($value)
    {
        return number_format($value, 0, '', '.');
    }

    public function scopeOrderFilter($query, $status)
    {
        return $query->where('order_status_id', $status ? '=' : '!=' , $status)
            ->where('user_id', auth()->id());
    }
}
