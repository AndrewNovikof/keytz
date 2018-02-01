<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * @var string
     */
    protected $table;

    /**
     * RolePolicy constructor.
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        $this->table = $model->getTable();
    }

    /**
     * @param User   $user
     * @param string $ability
     * @param Role $model
     *
     * @return bool
     */
    public function before(User $user, $ability, Role $model)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the role.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function view(User $user, Role $role)
    {
        if (!$user->hasPermissionTo("view $this->table")) {
            return false;
        };

        return true;
    }

    /**
     * Determine whether the user can display the role.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function display(User $user, Role $role)
    {
        if (!$user->hasPermissionTo("display $this->table")) {
            return false;
        };

        return true;
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if (!$user->hasPermissionTo("create $this->table")) {
            return false;
        };

        return true;
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        if (!$user->hasPermissionTo("update $this->table")) {
            return false;
        };

        return true;
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        if (!$user->hasPermissionTo("delete $this->table")) {
            return false;
        };

        return true;
    }
}
