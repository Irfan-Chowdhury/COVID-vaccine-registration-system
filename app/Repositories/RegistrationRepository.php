<?php

namespace App\Repositories;

use App\Contracts\RegistrationContract;
use App\Models\Registration;

class RegistrationRepository implements RegistrationContract
{
    public function show($nid)
    {
        return Registration::with('vaccineCenter')->where('nid', $nid)->first() ?? 0;
    }
}
