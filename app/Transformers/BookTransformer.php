<?php

namespace App\Transformers;

use App\Models\Book;
use League\Fractal\TransformerAbstract;

class BookTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'author',
    ];

    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected $availableIncludes = [
        'author',
        'catalogs'
    ];

    /**
     * A Fractal transformer.
     *
     * @param Book $book
     * @return array
     */
    public function transform(Book $book)
    {
        return [
            'id' => $book->id,
            'name' => $book->name,
            'text' => $book->text,
            'created' => $book->created_at
        ];
    }

    /**
     * Include author
     * @param Book $book
     * @return \League\Fractal\Resource\Item
     */
    public function includeAuthor(Book $book)
    {
        if ($author = $book->user) {
            return $this->item($author, new UserTransformer());
        }
    }

    /**
     * Include catalogs
     * @param Book $book
     * @return \League\Fractal\Resource\Item
     */
    public function includeCatalogs(Book $book)
    {
        if ($catalogs = $book->catalogs) {
            return $this->item($catalogs, new CatalogTransformer());
        }
    }
}
