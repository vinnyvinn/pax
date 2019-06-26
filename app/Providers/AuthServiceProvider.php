<?php

namespace App\Providers;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use PAX\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Passport::tokensExpireIn(Carbon::now()->addYears(20));

        Passport::refreshTokensExpireIn(Carbon::now()->addYears(30));

        $this->setupGates();
    }

    private function setupGates()
    {
        try {
            $permissions = Permission::all(['slug']);
            foreach ($permissions as $permission) {
                \Gate::define($permission->slug, function (User $user) use ($permission) {
                    $userPermissions = json_decode($user->permissions);

                    if (in_array('*', $userPermissions)) {
                        return true;
                    }

                    return in_array($permission->slug, $userPermissions);
                });
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
