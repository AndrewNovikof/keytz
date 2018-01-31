<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCatalogRequest;
use App\Http\Requests\UpdateCatalogRequest;
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
     * @param  StoreCatalogRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreCatalogRequest $request)
    {
        $this->authorize('create catalogs');
        return response()->json(fractal(
            Catalog::create($request->all()),
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
        $this->authorize('display', $catalog);
        return response()->json(fractal(
            $catalog,
            new CatalogTransformer,
            new ArraySerializer
        )->parseIncludes($request->get('includes')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCatalogRequest $request
     * @param  \App\Models\Catalog $catalog
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateCatalogRequest $request, Catalog $catalog)
    {
        $this->authorize('update', $catalog);
        return response()->json(fractal(
            $catalog->update($request->all()),
            new CatalogTransformer,
            new ArraySerializer
        )->parseIncludes($request->get('includes')));
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
        $catalog->delete();
        return response()->json('', 204);
    }
}
