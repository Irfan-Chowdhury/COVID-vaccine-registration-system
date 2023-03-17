<?php

namespace App\Contracts;

interface UserContract
{
    public function getAll();

    public function checkExists($nid, $date_of_birth);

    public function getUserInfo($nid, $date_of_birth);
}
