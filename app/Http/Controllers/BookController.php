<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Requests\CanRequest;
use App\Http\Requests\BooksRequest;
use App\Models\Book;
use App\Transformers\BookTransformer;
use Illuminate\Http\Request;
use League\Fractal\Serializer\ArraySerializer;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param BooksRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(BooksRequest $request)
    {
        $this->authorize('view books');
        return response()->json(fractal(
            Book::search($request->search)
                ->excludedCatalog($request->excluded_catalog)
                ->paginate($request->get('per_page', 10)),
            new BookTransformer,
            new ArraySerializer
        )->parseIncludes($request->includes));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BookRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(BookRequest $request)
    {
        $this->authorize('create books');
        return response()->json(fractal(
            auth()->user()->books()->create($request->all()),
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
     * @param  BookRequest $request
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(BookRequest $request, Book $book)
    {
        $this->authorize('update', $book);
        return response()->json($book->update($request->all()), 201);
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
        $book->catalogs()->detach();
        $book->delete();
        return response()->json('', 204);
    }

    /**
     * @param CanRequest $request
     * @param Book $book
     * @return mixed
     */
    public function can(CanRequest $request, Book $book)
    {
        return response()->json([
            'data' => auth()->user()->can($request->action, $book)
        ]);
    }
}
