<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Requests\CreateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \App\Http\Resources\UserCollection|\App\Http\Resources\UserCollection|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $users = $this->service->collection($request->all());

        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     * @return UserController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(CreateUserRequest $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return UserController|UserController|\Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        if (!$user) {
            return $this->error();
        }

        $data = new \App\Http\Resources\User($user);

        return $this->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return void
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return UserController|UserController|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user)
    {
        if ($this->service->update($user, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return UserController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
