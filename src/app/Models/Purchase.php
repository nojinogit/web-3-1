<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'item_id',
        'postcode',
        'address',
        'building',
        'payment',
        'deposited',
        'payment_intent_id',
        'send',
        'point',
        'cash'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
