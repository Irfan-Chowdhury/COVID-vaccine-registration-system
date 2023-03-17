<?php

namespace App\Console\Commands;

use App\Jobs\SendReminderEmailJob;
use App\Mail\VaccineReminderEmail;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails to vaccine registered users before the night of their upcoming schedule date.';

    public function handle(): void
    {
        date_default_timezone_set(env('APP_TIMEZONE'));

        $schedules = Registration::with('vaccineCenter')->whereDate('schedule_date', '=', Carbon::tomorrow()->toDateString())->get();

        foreach ($schedules as $schedule) {
            $name = $schedule->name;
            $scheduleDate = $schedule->schedule_date;
            $centerName = $schedule->vaccineCenter->center_name;

            dispatch(new SendReminderEmailJob($schedule->email, $name, $scheduleDate, $centerName));
        }
        $this->info('Successfully sent.');
    }
}

// php artisan reminder:send
