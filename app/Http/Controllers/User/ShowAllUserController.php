<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class ShowAllUserController extends Controller
{
    public function __invoke()
    {
        $users = User::all();

        return new UserResource(true, 'List Semua User', $users);
    }
}
