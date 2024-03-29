<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Dormitory;
use App\Models\Role;
use App\Models\SettlementHistory;
use App\Models\Student;
use App\Models\User;
use App\Policies\DormitoryPolicy;
use App\Policies\RolePolicy;
use App\Policies\SettlementHistoryPolicy;
use App\Policies\StudentPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Student::class => StudentPolicy::class,
        Dormitory::class => DormitoryPolicy::class,
        SettlementHistory::class => SettlementHistoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
