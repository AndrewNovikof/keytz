<?php

namespace App\Http\Controllers;

use App\Http\Requests\CanRequest;
use App\Http\Requests\CatalogRequest;
use App\Models\Book;
use App\Models\Catalog;
use App\Transformers\CatalogTransformer;
use Illuminate\Http\Request;
use League\Fractal\Serializer\ArraySerializer;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('view catalogs');
        return response()->json(fractal(
            Catalog::paginate($request->get('per_page', 10)),
            new CatalogTransformer,
            new ArraySerializer
        )->parseIncludes($request->get('includes')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CatalogRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CatalogRequest $request)
    {
        $this->authorize('create catalogs');
        return response()->json(fractal(
            auth()->user()->catalogs()->create($request->all()),
            new CatalogTransformer,
            new ArraySerializer
        )->parseIncludes($request->get('includes')), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalog $catalog
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Catalog $catalog, Request $request)
    {
        $this->authorize('view', $catalog);
        return response()->json(fractal(
            $catalog,
            new CatalogTransformer,
            new ArraySerializer
        )->parseIncludes($request->get('includes')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CatalogRequest $request
     * @param  \App\Models\Catalog $catalog
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(CatalogRequest $request, Catalog $catalog)
    {
        $this->authorize('update', $catalog);
        return response()->json($catalog->update($request->all()), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalog $catalog
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Catalog $catalog)
    {
        $this->authorize('delete', $catalog);
        $catalog->books()->detach();
        $catalog->delete();
        return response()->json('', 204);
    }

    /**
     * @param CanRequest $request
     * @param Catalog $catalog
     * @return mixed
     */
    public function can(CanRequest $request, Catalog $catalog)
    {
        return response()->json([
            'data' => auth()->user()->can($request->action, $catalog)
        ]);
    }

    /**
     * @param Catalog $catalog
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function attachBook(Catalog $catalog, Book $book)
    {
        $this->authorize('attachBook', $catalog);
        $catalog->books()->attach($book->id);
        return response()->json('', 204);
    }

    /**
     * @param Catalog $catalog
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function detachBook(Catalog $catalog, Book $book)
    {
        $this->authorize('detachBook', $catalog);
        $catalog->books()->detach($book->id);
        return response()->json('', 204);
    }
}
