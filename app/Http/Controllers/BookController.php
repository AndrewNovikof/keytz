<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Transformers\BookTransformer;
use Illuminate\Http\Request;
use League\Fractal\Serializer\ArraySerializer;

class BookController extends Controller
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
        $this->authorize('view books');
        return response()->json(fractal(
            Book::paginate($request->get('per_page', 10)),
            new BookTransformer,
            new ArraySerializer
        )->parseIncludes($request->get('includes')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBookRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreBookRequest $request)
    {
        $this->authorize('create books');
        return response()->json(fractal(
            Book::create($request->all()),
            new BookTransformer,
            new ArraySerializer
        )->parseIncludes($request->get('includes')), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book $book
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, Book $book)
    {
        $this->authorize('display', $book);
        return response()->json(fractal(
            $book,
            new BookTransformer,
            new ArraySerializer
        )->parseIncludes($request->get('includes')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateBookRequest $request
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $this->authorize('update', $book);
        return response()->json(fractal(
            $book->update($request->all()),
            new BookTransformer,
            new ArraySerializer
        )->parseIncludes($request->get('includes')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);
        $book->delete();
        return response()->json('', 204);
    }
}
