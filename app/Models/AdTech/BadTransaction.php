<?php

namespace App\Models\AdTech;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadTransaction extends Model
{
    use HasFactory;
    public function sub()
    {
        return $this->belongsTo(Sub::class);
    }
}
