<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CreateUserController extends Controller
{   
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'profile_picture' => 'required|mimes:png,jpg,jpeg|max:5048',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|string|unique:users',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ]);
        }

        $validated = $validator->validated();
        $validated['password'] = bcrypt($validated['password']);
        if ($validated['profile_picture']) {
            $extension = $validated['profile_picture']->extension();
            $fileName = $validated['firstname'].'_'.'profile'.'_'.uniqid().$extension;

            $path = Storage::putFileAs('public/image/profile', $validated['profile_picture'] , $fileName);
            $link = Storage::url($path);
            $validated['profile_picture'] = $link;
        }

        try {
            $user = new User();
            $user->first_name = $validated['firstname'];
            $user->last_name = $validated['lastname'];
            $user->profile_picture = $validated['profile_picture'];
            $user->username = $validated['username'];
            $user->email = $validated['email'];
            $user->phone_number = $validated['phone_number'];
            $user->password = $validated['password'];
            
            $user->save();
            $response = new UserResource(true, 'membuat user', $user);
            
            return $response;
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
