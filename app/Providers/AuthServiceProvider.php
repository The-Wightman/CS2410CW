<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Event;
use Auth;

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

	/**
			Purpose: Load and define gates to oversee authentication
			Parameters: A user and A event (for the inner function)
			Description: When the authservice provider boot is called it creates a gate to ensure the current user ID and he current event ID matches to restrict access to certain functions by returning a boolean of either true or false.
	*/
	
    public function boot()
    {
	
        $this->registerPolicies();

        Gate::define('AuthCheck', function ($user, $event) {
        return $event->user_id == $user->id;
	 });

	Gate::define('AuthCheckUser', function ($user) {
        return $user->id == Auth::user()->id;
	 });

	
    }
	

	
}
