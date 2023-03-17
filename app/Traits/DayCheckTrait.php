<?php

namespace App\Traits;

trait DayCheckTrait
{
    public function getExpectedDate($currentDate)
    {
        $currentDate->modify('+7 days');
        $dayOfWeek = $currentDate->format('w');

        if ($dayOfWeek == 5) { // Friday
            return $currentDate->modify('+2 days')->format('Y-m-d');
        } elseif ($dayOfWeek == 6) { // Saturday
            return $currentDate->modify('+1 day')->format('Y-m-d');
        } else {
            return $currentDate->format('Y-m-d');
        }
    }
}
