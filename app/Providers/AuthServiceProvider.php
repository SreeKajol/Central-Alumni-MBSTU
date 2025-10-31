<?php

namespace App\Providers;

use App\Models\AlumniProfile;
use App\Models\Department;
use App\Models\Event;
use App\Models\News;
use App\Policies\AlumniProfilePolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\EventPolicy;
use App\Policies\NewsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Department::class => DepartmentPolicy::class,
        AlumniProfile::class => AlumniProfilePolicy::class,
        Event::class => EventPolicy::class,
        News::class => NewsPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
