<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    protected $fillable = [
        'from_user_id', 'to_user_id', 'status'
    ];
}
