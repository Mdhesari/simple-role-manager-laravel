<?php

namespace Mdhesari\RoleManager\Traits;

use Mdhesari\RoleManager\Exceptions\RoleGetRoleRepositoryFunctionIsNotFound;
use Mdhesari\RoleManager\Exceptions\RoleRepositoryIsNotLoaded;

abstract class PermissionRoles
{
    public static $ADMIN_ROLE = 'admin';

    public static $OPERATOR_ROLE = 'operator';

    public function hasRole(string $role)
    {
        return $this->roles()->pluck('name')->contains($role);
    }

    public function isAdmin()
    {

        return $this->hasRole('admin');
    }

    protected function parseRole(string $role)
    {

        if (!method_exists($this, 'getRoleRepository')) {

            throw new RoleGetRoleRepositoryFunctionIsNotFound;
        }

        $repository = $this->getRoleRepository();

        if (is_null($repository))
            throw new RoleRepositoryIsNotLoaded;

        $role = $repository->findByName($role);

        if ($role->isEmpty())
            return false;

        return $role;
    }

    public function promote(string $role)
    {

        $role = $this->parseRole($role);

        return $role ? $this->roles()->attach($role) : $role;
    }

    public function dismiss(string $role)
    {

        $role = $this->parseRole($role);

        return $role ? $this->roles()->detach($role) : $role;
    }

    public function promoteAdmin()
    {

        return $this->promote(static::$ADMIN_ROLE);
    }

    public function promoteOperator()
    {

        return $this->promote(static::$OPERATOR_ROLE);
    }

    public function dismissAdmin()
    {

        return $this->dismiss(static::$ADMIN_ROLE);
    }

    public function dismissOperator()
    {

        return $this->dismiss(static::$OPERATOR_ROLE);
    }

    public function dismissAll()
    {

        return $this->roles()->sync([]);
    }
}
