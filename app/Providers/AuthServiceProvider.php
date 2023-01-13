<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Requirements;
use App\Policies\NotePolicy;
use App\Policies\PayPolicy;
use App\Policies\RequirementsPolicy;
use App\Policies\SubjectPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Requirements::class => RequirementsPolicy::class,
        Pay::class => PayPolicy::class,
        Category::class => SubjectPolicy::class,
        Note::class => NotePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
