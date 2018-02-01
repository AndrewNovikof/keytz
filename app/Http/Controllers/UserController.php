<?php

namespace App\Http\Controllers;

use App\Http\Requests\CanRequest;
use App\Transformers\UserTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use League\Fractal\Serializer\ArraySerializer;

class UserController extends Controller
{
    /**
     * Take auth user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        return response()->json(fractal(
            auth()->user(),
            new UserTransformer,
            new ArraySerializer()
        )->parseIncludes($request->get('includes')));
    }

    /**
     * @param CanRequest $request
     * @return mixed
     */
    public function can(CanRequest $request)
    {
        return response()->json([
            'data' => auth()->user()->can($request->action)
        ]);
    }
}
