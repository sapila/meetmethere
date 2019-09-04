<?php

namespace App;

use App\Dto\FriendRequestDto;
use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    protected $fillable = [
        'from_user_id', 'to_user_id', 'status'
    ];

    public function toDto()
    {
        $friendRequest = new FriendRequestDto();
        $friendRequest->setId($this->id);
        $friendRequest->setFromUserId($this->from_user_id);
        $friendRequest->setToUserId($this->to_user_id);
        $friendRequest->setStatus($this->status);

        return $friendRequest;
    }
}
