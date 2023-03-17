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

    public function count($vaccine_center_id, $expectedDate)
    {
        return Registration::where('vaccine_center_id', $vaccine_center_id)
                            ->where('schedule_date', $expectedDate)
                            ->count();
    }

    public function store($request, $confirmDate)
    {
        Registration::create([
            'vaccine_center_id' => $request->vaccine_center_id,
            'nid' => $request->nid,
            'name' => $request->name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'schedule_date' => $confirmDate,
            'status' => 'Scheduled',
        ]);
    }
}
