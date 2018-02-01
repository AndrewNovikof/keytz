<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Spatie\Permission\Models\Role;

class RoleTransformer extends TransformerAbstract
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected $availableIncludes = [
        'users',
        'permissions'
    ];

    /**
     * A Fractal transformer.
     *
     * @param Role $role
     * @return array
     */
    public function transform(Role $role)
    {
        return [
            'name' => $role->name
        ];
    }

    /**
     * Include users
     *
     * @param Role $role
     * @return \League\Fractal\Resource\Collection
     */
    public function includeUsers(Role $role)
    {
        if ($users = $role->users) {
            return $this->collection($users, new UserTransformer());
        }
    }

    /**
     * Include permissions
     *
     * @param Role $role
     * @return \League\Fractal\Resource\Collection
     */
    public function includePermissions(Role $role)
    {
        if ($permissions = $role->permissions) {
            return $this->collection($permissions, new PermissionTransformer());
        }
    }
}
