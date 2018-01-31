<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @var string
     */
    protected $table;

    /**
     * UserPolicy constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->table = $user->getTable();
    }

    /**
     * @param User   $user
     * @param string $ability
     * @param User $model
     *
     * @return bool
     */
    public function before(User $user, $ability, User $model)
    {
        if ($user->hasRole('admin') || $model->id === $user->id) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
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
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function display(User $user, User $model)
    {
        if (!$user->hasPermissionTo("display $this->table")) {
            return false;
        };

        return true;
    }

    /**
     * Determine whether the user can create models.
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
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        if (!$user->hasPermissionTo("update $this->table")) {
            return false;
        };

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        if (!$user->hasPermissionTo("delete $this->table")) {
            return false;
        };

        return true;
    }
}
