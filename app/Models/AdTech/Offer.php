<?php

namespace App\Models\AdTech;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Offer extends Model
{
    use HasFactory;

    protected $attributes = [
        'is_active' => false,
    ];

    //связь с таблицей Users
    public function user()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

}
