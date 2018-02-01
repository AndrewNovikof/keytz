<?php

namespace App\Transformers;

use App\Models\Catalog;
use League\Fractal\TransformerAbstract;

class CatalogTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'owner',
    ];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $availableIncludes = [
        'owner',
        'books'
    ];

    /**
     * A Fractal transformer.
     *
     * @param Catalog $catalog
     * @return array
     */
    public function transform(Catalog $catalog)
    {
        return [
            'id' => $catalog->id,
            'name' => $catalog->name,
            'is_public' => $catalog->is_public
        ];
    }

    /**
     * Include books
     *
     * @param Catalog $catalog
     * @return \League\Fractal\Resource\Collection
     */
    public function includeBooks(Catalog $catalog)
    {
        if ($books = $catalog->books) {
            return $this->collection($books, new BookTransformer());
        }
    }

    /**
     * Include books
     *
     * @param Catalog $catalog
     * @return \League\Fractal\Resource\Item
     */
    public function includeOwner(Catalog $catalog)
    {
        if ($owner = $catalog->user) {
            return $this->item($owner, new UserTransformer());
        }
    }
}
