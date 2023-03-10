<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class CreateUserController extends Controller
{   
    public function __invoke(CreateUserRequest $request)
    {
        $validated = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'profile_picture' => $request->profile_picture,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => $request->password,
        ];

        if ($validated['profile_picture']) {
            $file = filePath($validated['profile_picture']);
            $validated['profile_picture'] = $file;
        }

        try {
            $user = new User();

            $user->first_name = $validated['firstname'];
            $user->last_name = $validated['lastname'];
            $user->profile_picture = $validated['profile_picture'];
            $user->username = $validated['username'];
            $user->email = $validated['email'];
            $user->phone_number = $validated['phone_number'];
            $user->password = bcrypt($validated['password']);
            
            $user->save();
            
            return new UserResource(true, 'membuat user', $user);
        } catch (\Exception $e) {
            return new ErrorResource(false, 'error', $e->getMessage());
        }
    }
}
