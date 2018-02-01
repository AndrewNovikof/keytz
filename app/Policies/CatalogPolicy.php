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
     * @param Catalog $model
     */
    public function __construct(Catalog $model)
    {
        $this->table = $model->getTable();
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
     * Determine whether the user can display the catalog.
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

    /**
     * Determine whether the user can attach book to the catalog.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Catalog  $catalog
     * @return mixed
     */
    public function attachBook(User $user, Catalog $catalog)
    {
        if ($user->id !== $catalog->user_id && !$catalog->is_public) {
            return false;
        };

        return true;
    }

    /**
     * Determine whether the user can detach book from the catalog.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Catalog  $catalog
     * @return mixed
     */
    public function detachBook(User $user, Catalog $catalog)
    {
        if ($user->id !== $catalog->user_id && !$catalog->is_public) {
            return false;
        };

        return true;
    }
}
