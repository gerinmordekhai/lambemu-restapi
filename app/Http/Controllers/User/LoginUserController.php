<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Resources\User\LoginUserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginUserController extends Controller
{
    public function __invoke(LoginUserRequest $request)
    {
        $username = $request->username;
        $password = $request->password;
        
        try {
            if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $user = User::where('email', $username)->first();
    
                if (!$user || !Hash::check($password, $user->password)) {
                    return response()->json([
                        'message' => "this credentials doesn't match our records"
                    ]);
                }
    
                $token = $user->createToken($username)->plainTextToken;
    
                return new LoginUserResource(true, 'data login', $token, $user);
            } else {
                $user = User::where('username', $username)->first();
    
                if (!$user || !Hash::check($password, $user->password)) {
                    return response()->json([
                        'message' => "this credentials doesn't match our records"
                    ]);
                }
    
                $token = $user->createToken($username)->plainTextToken;
    
                return new LoginUserResource(true, 'data login', $token, $user);
            }
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage(),
            ]);
        }
    }
}
