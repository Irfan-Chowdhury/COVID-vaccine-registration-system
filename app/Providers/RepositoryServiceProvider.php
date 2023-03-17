<?php

namespace App\Providers;

use App\Contracts\VaccineCenterContract;
use App\Repositories\VaccineCenterRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register() : void
    {
        $this->app->bind(VaccineCenterContract::class, VaccineCenterRepository::class);
    }
}

?>
