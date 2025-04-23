<?php

namespace App\Providers;
use App\Interfaces\AcademicSettingInterface;
use App\Repositories\AcademicSettingRepository;
use Illuminate\Support\ServiceProvider;

class AcademicSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AcademicSettingInterface::class, AcademicSettingRepository::class);
        $this->app->bind(CourseInterface::class, CourseRepository::class);
        $this->app->bind(SchoolClassInterface::class, SchoolClassRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
