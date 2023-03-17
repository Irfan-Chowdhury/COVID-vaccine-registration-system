<?php

namespace App\Repositories;

use App\Contracts\UserContract;
use App\Models\User;

class UserRepository implements UserContract
{
    public function getAll()
    {
        return User::get();
    }
}
