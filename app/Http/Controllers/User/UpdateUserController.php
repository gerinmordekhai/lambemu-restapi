<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateUserController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $user = Auth::user();

            $validated = $request->validate([
                'firstname' => 'alpha',
                'lastname' => 'alpha',
                'profile_picture' => 'mimes:png,jpg,jpeg|max:5048',
                'username' => 'unique:users',
                'phone_number' => 'unique:users'
            ]);
            
            if ($request->hasFile('profile_picture')) {
                $file = filePath($validated['profile_picture']);
                $validated['profile_picture'] = $file;
                Storage::delete('public/image/profile'.$user->profile_picture);
            }
            
            $this->update($user->id, $validated);
            $udpatedUser = $user;
            
            return new UserResource(true, 'data updated', $udpatedUser);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }

    }

    private function update($id, $data)
    {
        try {
            $user = User::where('id', $id)->update($data);
            return $user;
        } catch (\Exception $e) {
            return response()->json([
                'message method udpate' => $e->getMessage(),
            ]);
        }
    }
}
