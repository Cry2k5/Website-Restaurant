<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['image_path', 'gallery_category_id']; // Thay đổi name của cột

    // Mối quan hệ với bảng gallery_categories
    public function category(): BelongsTo
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id'); // Thay đổi cột khóa ngoại
    }
}
