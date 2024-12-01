<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RestaurantTable extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $primaryKey = 'table_id';
    protected $fillable = ['capacity', 'state'];
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class,'table_id');
    }
}
