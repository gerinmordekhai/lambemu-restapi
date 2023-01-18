<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutUserController extends Controller
{
    public function __invoke()
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged Out.'
        ]);
    }
}
