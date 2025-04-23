<?php

namespace App\Providers;

use App\Interfaces\AcademicSettingInterface;
use App\Interfaces\SchoolClassInterface;
use App\Interfaces\SchoolSessionInterface;
use App\Interfaces\SectionInterface;
use App\Interfaces\SemesterInterface;
use App\Interfaces\UserInterface;
use App\Repositories\AcademicSettingRepository;
use App\Repositories\SchoolClassRepository;
use App\Repositories\SchoolSessionRepository;
use App\Repositories\SectionRepository;
use App\Repositories\SemesterRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(AcademicSettingInterface::class, AcademicSettingRepository::class);
        $this->app->bind(SchoolSessionInterface::class, SchoolSessionRepository::class);
        $this->app->bind(SectionInterface::class, SectionRepository::class);
        $this->app->bind(SemesterInterface::class, SemesterRepository::class);
        $this->app->bind(SchoolClassInterface::class, SchoolClassRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
