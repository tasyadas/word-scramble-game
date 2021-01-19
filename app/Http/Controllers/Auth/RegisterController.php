<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|unique:users',
            'password' => 'required'
        ]);

        $user = new User([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->role()->associate(Role::find(2));
        $user->save();

        return [
            'response_code'    => "00",
            'response_message' => 'Akun berhasil ditambahkan!',
            'data'             => $user
        ];
    }
}
