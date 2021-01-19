<?php

namespace App\Http\Controllers\History;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * HistoryController constructor.
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return User::where('score', '!=', 0)->get();
    }
}
