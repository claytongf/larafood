<?php

namespace App\Listeners;

use App\Models\Role;
use App\Tenant\Events\TenantCreatedEvent;

class AddRoleTenantListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TenantCreatedEvent $event)
    {
        $user = $event->user();

        if (!$role = Role::first()) {
            return;
        }

        $user->roles()->attach($role);

        return true;
    }
}
