<?php

namespace App\Providers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('edit_profile', function (Student $user, Student $student) {
            if($user->role == 'admin' || $user->id === $student->id)
            {
                return true;
            }
        });
        // Gate::define('edit_profile', function (User $user, Student $student) {
        //     return $user->id === $student->student_id;
        // });

        // Gate::define('edit_profile', function ($user, Student $student) {
        //     if($user->role == 'admin')
        //     {
        //         $user->id === $student->student_id;
        //     }

        //     return $user->id === $student->student_id;
        // });
        
    }
}
