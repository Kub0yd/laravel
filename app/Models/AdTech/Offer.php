<?php

namespace App\Models\AdTech;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\AdTech\Sub;
use App\Models\AdTech\Transaction;

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
    public function subs()
    {
        return $this->hasMany(Sub::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
