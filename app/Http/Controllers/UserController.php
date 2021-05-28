<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function show(User $user)
    {
        return $user;
    }

    public function store(Request $request)
    {
        $user = User::create(
            $request->only('first_name', 'last_name', 'email', 'role_id')
            + ['password' => Hash::make('bassword')]
        );

        return response($user, Response::HTTP_CREATED);

    }

    public function update(Request $request, User $user)
    {
        $user->update(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ]
        );
        $user->save();

        return response($user, Response::HTTP_ACCEPTED);

    }

    public function destroy(User $user)
    {
        $user->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
