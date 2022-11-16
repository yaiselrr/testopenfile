<?php

namespace App\Dto;

use App\Models\User;

class UserDto
{
    // use JsonSerializeTrait;

    public $id;
    public $name;
    public $email;
    public $role;

    public function __construct($userDto)
    {
        $user = User::find($userDto->id);

        $this->id = $userDto->id;
        $this->name = $userDto->name;
        $this->email = $userDto->email;
        $this->role = $user->is_client ? "Client" : "Admin";

    }

}