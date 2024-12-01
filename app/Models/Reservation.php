<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'reservation_id';
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'customer_email',
        'table_id',
        'reservation_time',
        'reservation_date',
        'description',
    ];

    public function table(): BelongsTo{
      return $this->belongsTo(RestaurantTable::class,'table_id');
    }

}
