<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditUserRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateUserController extends Controller
{
    public function __invoke(EditUserRequest $request)
    {
        try {
            $user = Auth::user();

            $validated = [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'profile_picture' => $request->profile_picture,
                'username' => $request->username,
                'phone_number' => $request->phone_number
            ];
            
            if ($request->hasFile('profile_picture')) {
                $file = filePath($validated['profile_picture']);
                $validated['profile_picture'] = $file;
                Storage::delete('public/image/profile'.$user->profile_picture);
            }
            
            $this->update($user->id, $validated);
            $udpatedUser = $user;
            
            return new UserResource(true, 'data updated', $udpatedUser);
        } catch (\Exception $e) {
            return new ErrorResource(false, 'error', $e->getMessage());
        }

    }

    private function update($id, $data)
    {
        try {
            $user = User::where('id', $id)->update($data);
            return $user;
        } catch (\Exception $e) {
            return new ErrorResource(false, 'error', $e->getMessage());
        }
    }
}
