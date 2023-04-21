<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    public function me()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function you()
    {
        return $this->hasOne(User::class,'id','other_user_id');
    }
}