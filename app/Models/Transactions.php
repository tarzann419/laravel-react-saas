<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'credits',
        'status',
        'price',
        'session_id',
        'package_id',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
