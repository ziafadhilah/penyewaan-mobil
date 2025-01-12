<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    //
    use HasFactory;

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function returned()
    {
        return $this->hasOne(Returned::class);
    }
}
