<?php

namespace App;

use App\Dto\GroupDto;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name', 'description', 'owner_user_id'
    ];

    public function toDto()
    {
        $group = new GroupDto();

        $group->setId($this->id);
        $group->setName($this->name);
        $group->setDescription($this->description);
        $group->setOwnerUserId($this->owner_user_id);

        return $group;
    }
}
