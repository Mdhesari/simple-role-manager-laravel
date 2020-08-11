<?php

namespace Mdhesari\RoleManager\Traits;

use Illuminate\Support\Traits\Macroable;
use Mdhesari\RoleManager\Models\Role;

trait PermissionRoles
{

    use Macroable {
        __call as methodCall;
    }

    /**
     * Check if there is a role with this name
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role)
    {
        return $this->roles()->pluck('name')->contains($role);
    }

    /**
     * Check if the user is admin
     *
     * @return bool
     */
    public function isAdmin()
    {

        return $this->hasRole('admin');
    }

    /**
     * Get specific role by name
     *
     * @param string $role
     * @return bool|mixed
     */
    protected function parseRole(string $role)
    {

        $role = Role::where('name', $role)->first();

        if (is_null($role))
            return false;

        return $role;
    }

    /**
     * Assign a user to a role
     *
     * @param string $role
     * @return mixed
     */
    public function promote(string $role)
    {

        $role = $this->parseRole($role);

        return $role ? $this->roles()->attach($role) : $role;
    }

    /**
     * Dis assign a user from a role
     *
     * @param string $role
     * @return mixed
     */
    public function dismiss(string $role)
    {

        $role = $this->parseRole($role);

        return $role ? $this->roles()->detach($role) : $role;
    }

    /**
     * Drop all roles for a user
     *
     * @return mixed
     */
    public function dismissAll()
    {

        return $this->roles()->sync([]);
    }

    /**
     * Setup custom macros
     *
     * @return void
     */
    public function setupCustomMacros()
    {

        /**
         * get roles and based on them declare methods in order to access promote and dismiss easier
         */
        $roles = config('permissions.roles');

        foreach ($roles as $role) {

            $this->macro('promote' . ucfirst($role), function () use ($role) {

                $this->promote($role);
            });

            $this->macro('dismiss' . ucfirst($role), function () use ($role) {

                $this->dismiss($role);
            });
        }
    }

    /**
     * Overload __call method of macroable
     *
     * @param  mixed $method
     * @param  mixed $parameters
     * @return void
     */
    public function __call($method, $parameters)
    {

        $this->setupCustomMacros();

        return $this->methodCall($method, $parameters);
    }
}
