<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * @var string
     */
    protected $table;

    /**
     * PermissionPolicy constructor.
     * @param Permission $model
     */
    public function __construct(Permission $model)
    {
        $this->table = $model->getTable();
    }

    /**
     * @param User   $user
     * @param string $ability
     * @param Permission $model
     *
     * @return bool
     */
    public function before(User $user, $ability, Permission $model)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the permission.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return mixed
     */
    public function view(User $user, Permission $permission)
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
     * @param  Permission  $model
     * @return mixed
     */
    public function display(User $user, Permission $model)
    {
        if (!$user->hasPermissionTo("view $this->table")) {
            return false;
        };

        return true;
    }

    /**
     * Determine whether the user can create permissions.
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
     * Determine whether the user can update the permission.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return mixed
     */
    public function update(User $user, Permission $permission)
    {
        if (!$user->hasPermissionTo("update $this->table")) {
            return false;
        };

        return true;
    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Permission  $permission
     * @return mixed
     */
    public function delete(User $user, Permission $permission)
    {
        if (!$user->hasPermissionTo("delete $this->table")) {
            return false;
        };

        return true;
    }

    /**
     * @param User $user
     * @param Permission $permission
     *
     * @return bool
     */
    public function edit(User $user, Permission $permission)
    {
        if (!$user->hasPermissionTo("edit $this->table")) {
            return false;
        };
        return true;
    }
}
