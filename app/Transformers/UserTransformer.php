<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected $availableIncludes = [
        'books',
        'catalogs'
    ];

    /**
     * A Fractal transformer.
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ];
    }

    /**
     * Include catalogs
     *
     * @param User $user
     * @return \League\Fractal\Resource\Collection
     */
    public function includeCatalogs(User $user)
    {
        if ($catalogs = $user->catalogs) {
            return $this->collection($catalogs, new CatalogTransformer());
        }
    }

    /**
     * Include books
     *
     * @param User $user
     * @return \League\Fractal\Resource\Collection
     */
    public function includeBooks(User $user)
    {
        if ($books = $user->books) {
            return $this->collection($books, new BookTransformer());
        }
    }
}
