<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Spatie\Permission\Contracts\Permission;

class PermissionTransformer extends TransformerAbstract
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected $availableIncludes = [
        'roles'
    ];

    /**
     * A Fractal transformer.
     *
     * @param Permission $permission
     * @return array
     */
    public function transform(Permission $permission)
    {
        return [
            'name' => $permission->name
        ];
    }

    /**
     * Include roles
     *
     * @param Permission $permission
     * @return \League\Fractal\Resource\Collection
     */
    public function includeRoles(Permission $permission)
    {
        if ($roles = $permission->roles) {
            return $this->collection($roles, new RoleTransformer());
        }
    }
}
