<?php

namespace App\Jobs;

use App\Mail\RegistrationSuccessfulMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRegSuccessfulEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $name;
    protected $confirmDate;
    public function __construct($email, $name, $confirmDate)
    {
        $this->email = $email;
        $this->name = $name;
        $this->confirmDate = $confirmDate;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)
        ->send(new RegistrationSuccessfulMail($this->name, $this->confirmDate));
    }
}
