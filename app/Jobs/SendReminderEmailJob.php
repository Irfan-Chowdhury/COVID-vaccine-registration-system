<?php

namespace App\Jobs;

use App\Mail\VaccineReminderEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReminderEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $name;
    public $scheduleDate;
    public $centerName;

    public function __construct($email, $name, $scheduleDate, $centerName)
    {
        $this->email = $email;
        $this->name = $name;
        $this->scheduleDate = $scheduleDate;
        $this->centerName = $centerName;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)
        ->send(new VaccineReminderEmail($this->name, $this->scheduleDate, $this->centerName));
    }
}
