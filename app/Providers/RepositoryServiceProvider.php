<?php

namespace App\Providers;

use App\Contracts\RegistrationContract;
use App\Contracts\UserContract;
use App\Contracts\VaccineCenterContract;
use App\Repositories\RegistrationRepository;
use App\Repositories\UserRepository;
use App\Repositories\VaccineCenterRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(VaccineCenterContract::class, VaccineCenterRepository::class);
        $this->app->bind(UserContract::class, UserRepository::class);
        $this->app->bind(RegistrationContract::class, RegistrationRepository::class);
    }
}
