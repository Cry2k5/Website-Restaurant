<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'customer_email',
        'table_id',
        'reservation_time',
        'reservation_date',
        'description',
    ];
}
