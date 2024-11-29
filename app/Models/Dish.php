<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dish extends Model
{
    use HasFactory;
    protected $primaryKey = 'dish_id';

    public $timestamps = false;

    protected $fillable = [
        'cate_id',
        'dish_name',
        'image',
        'dish_price',
    ];
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'cate_id','cate_id');
    }

}
