<?php

namespace App\Contracts;

interface VaccineCenterContract
{
    public function getAll();

    public function get($id);
}
