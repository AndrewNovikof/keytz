<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Catalog;
use Illuminate\Auth\Access\HandlesAuthorization;

class CatalogPolicy
{
    use HandlesAuthorization;

    /**
     * @var string
     */
    protected $table;

    /**
     * CatalogPolicy constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->table = $user->getTable();
    }

    /**
     * @param User   $user
     * @param string $ability
     * @param Catalog $model
     *
     * @return bool
     */
    public function before(User $user, $ability, Catalog $model)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the catalog.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Catalog  $catalog
     * @return mixed
     */
    public function view(User $user, Catalog $catalog)
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
     * @param  Catalog  $catalog
     * @return mixed
     */
    public function display(User $user, Catalog $catalog)
    {
        if (!$user->hasPermissionTo("display $this->table")) {
            return false;
        };

        return true;
    }

    /**
     * Determine whether the user can create catalogs.
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
     * Determine whether the user can update the catalog.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Catalog  $catalog
     * @return mixed
     */
    public function update(User $user, Catalog $catalog)
    {
        if (($user->id !== $catalog->user_id) && !$catalog->is_public) {
            return false;
        };

        return true;
    }

    /**
     * Determine whether the user can delete the catalog.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Catalog  $catalog
     * @return mixed
     */
    public function delete(User $user, Catalog $catalog)
    {
        if ($user->id !== $catalog->user_id) {
            return false;
        };

        return true;
    }
}
