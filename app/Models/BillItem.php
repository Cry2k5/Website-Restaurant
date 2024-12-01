<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'bill_item_id';
    public $timestamps = false;
    protected $fillable=[
        'bill_item_id',
        'bill_id',
        'dish_id',
        'quantity',
    ];
    public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class);
    }
    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class, 'dish_id');
    }
}
