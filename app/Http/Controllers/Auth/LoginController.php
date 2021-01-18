<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email'    => 'required',
            'password' => 'required'
        ]);

        if (!$token = auth()->attempt($request->only('email', 'password'))) {
            return response(null, 401);
        }

        return response()->json(compact('token'));
    }
}
