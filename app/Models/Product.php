<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Product.php model dosyası
class Product extends Model
{
    protected $fillable = ['name', 'price', 'image_url', 'description']; // Açıklama ekleyin
}


