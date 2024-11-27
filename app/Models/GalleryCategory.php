<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name'];

    // Mối quan hệ một-nhiều với bảng galleries
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'gallery_category_id'); // Cột khóa ngoại trong bảng galleries
    }
}
