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

    public function checkExists($nid, $date_of_birth)
    {
        return User::where('nid', $nid)
                    ->where('date_of_birth', $date_of_birth)
                    ->exists();
    }

    // R
    public function getUserInfo($nid, $date_of_birth)
    {
        return User::where('nid', $nid)
            ->where('date_of_birth', $date_of_birth)
            ->first();
    }
}
