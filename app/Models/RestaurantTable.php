<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $primaryKey = 'table_id';
    protected $fillable = ['capacity', 'state'];
}
