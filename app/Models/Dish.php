<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return $this->belongsTo(Category::class, 'cate_id');
    }
public function bill_order(): BelongsToMany
{
        return $this->belongsToMany(Bill::class, 'bill_items', 'dish_id', 'bill_id');
}
}
