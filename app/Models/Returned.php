<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returned extends Model
{
    use HasFactory;

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
