<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];


    protected function foto(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? url($value) : url('gambar/sistem/produk.png')
        );
    }
}
