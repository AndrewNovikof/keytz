<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Transformers\BookTransformer;
use App\Transformers\CatalogTransformer;
use Illuminate\Http\Request;
use League\Fractal\Serializer\ArraySerializer;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(fractal(
            Book::paginate($request->get('per_page', 10)),
            new BookTransformer,
            new ArraySerializer
        )->parseIncludes($request->get('includes')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book $book
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, Request $request)
    {
        return response()->json(fractal(
            $book,
            new BookTransformer,
            new ArraySerializer
        )->parseIncludes($request->get('includes')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
