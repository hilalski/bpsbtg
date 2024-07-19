<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\StatusPengadaan;
use App\Observers\StatusPengadaanObserver;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('pbj', function (User $user) {
            return $user->roles->firstWhere('name', 'PBJ') !== null;
        });

        Gate::define('ppk', function (User $user) {
            return $user->roles->firstWhere('name', 'PPK') !== null;
        });

        Gate::define('tim keuangan', function (User $user) {
            return $user->roles->firstWhere('name', 'Tim Keuangan') !== null;
        });

        Gate::define('pegawai', function (User $user) {
            return $user->roles->firstWhere('name', 'Pegawai') !== null;
        });

        Gate::define('pimpinan', function (User $user) {
            return $user->roles->firstWhere('name', 'Pimpinan') !== null;
        });

        Gate::define('operator', function (User $user) {
            return $user->roles->firstWhere('name', 'Operator') !== null;
        });

        StatusPengadaan::observe(StatusPengadaanObserver::class);
    }
}
