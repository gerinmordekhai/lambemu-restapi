<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Resources\User\UserResource;
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
                $user = $this->whereQuery('email', $username, $password);
                $token = $user->createToken($username)->plainTextToken;
    
                return new UserResource(true, 'data login', $user, $token);
            } else {
                $user = $this->whereQuery('username', $username, $password);
                $token = $user->createToken($username)->plainTextToken;
    
                return new UserResource(true, 'data login', $user, $token);
            }
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage(),
            ]);
        }
    }

    private function getPassword($password)
    {
        $credentials = new LoginUserRequest();
        $credentials = $credentials->getPasswordCredentials($password);

        return $credentials['password'];
    }

    private function whereQuery($column, $username, $password)
    {
        $user = User::where($column, $username)->first();
    
        if (!$user || !Hash::check($this->getPassword($password), $user->password)) {
            return response()->json([
                'message' => "this credentials doesn't match our records"
            ]);
        }

        return $user;
    }
}
