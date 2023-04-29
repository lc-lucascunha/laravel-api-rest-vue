<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getNameAttribute($value)
    {
        return mb_strtoupper($value, 'UTF-8');
    }

    public function getCreatedAtAttribute($value)
    {
        $value = explode('T', $value);
        $date = implode('/', array_reverse(explode('-', $value[0])));
        $time = substr($value[1], 0, 8);
        return "{$date} {$time}";
    }

    public function getUpdatedAtAttribute($value)
    {
        $value = explode('T', $value);
        $date = implode('/', array_reverse(explode('-', $value[0])));
        $time = substr($value[1], 0, 8);
        return "{$date} {$time}";
    }
}
