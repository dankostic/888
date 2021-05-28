<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
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
    /**
     * @return Response
     */
    public function index(): Response
    {
        return response(User::all(), Response::HTTP_OK);
    }

    /**
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
        return response($user, Response::HTTP_OK);
    }

    /**
     * @param UserCreateRequest $request
     * @return Response
     */
    public function store(UserCreateRequest $request): Response
    {
        $user = User::create(
            $request->only('first_name', 'last_name', 'username', 'email', 'role_id')
            + ['password' => Hash::make('bassword')]
        );

        return response($user, Response::HTTP_CREATED);
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $user
     * @return Response
     */
    public function update(UserUpdateRequest $request, User $user): Response
    {
        $user->update($request->only('first_name', 'last_name', 'username', 'email'));

        return response($user, Response::HTTP_ACCEPTED);
    }

    /**
     * @param User $user
     * @return Response
     */
    public function destroy(User $user): Response
    {
        $user->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
