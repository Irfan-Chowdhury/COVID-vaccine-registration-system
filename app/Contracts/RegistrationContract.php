<?php

namespace App\Contracts;

interface RegistrationContract
{
    public function show($nid);

    public function count($vaccine_center_id, $expectedDate);

    public function store($request, $confirmDate);
}
