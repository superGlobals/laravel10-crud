<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'quantity',
        'price',
        'image'
    ];

    public static function deleteOldImage($fileName)
    {
        $imagePath = public_path()."/images/";
            $image = $imagePath . $fileName;

            if(file_exists($image)) {
                @unlink($image);
            }
    }
}
