<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = "cate_id";
    public $timestamps = false;

    public function dishes() :HasMany
    {
        return $this->hasMany(Dish::class,'cate_id','cate_id');
    }

}
