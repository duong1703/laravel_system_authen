<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\api\v1\token;
use Auth;
use Laravel\Passport\HasApiTokens;
use Hash;
use Str;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'userName' => 'required|string|max:255',
            'userPassword' => 'required|string|min:8|max:64',
            'userEmail' => 'required|string|email|max:255|unique:user',
            'userFirstName' => 'required|string|max:100',
            'userLastName' => 'required|string|max:100',
            'userMiddleName' => 'nullable|string|max:100',
            'userGender' => 'required|integer', //1 nam 0 nữ
            'userBirthday' => 'required',
            'userJoinDate' => 'required|integer',
            'userLoginDate' => 'required|integer',
            'userExpireDate' => 'required|integer',
            'createBy' => 'required|integer',
            'updateBy' => 'required|integer',
        ]);

        // Create user
        \App\Models\api\v1\user::create([
            'userName' => $request->userName,
            'userPassword' => Hash::make($request->userPassword),
            'userEmail' => $request->userEmail,
            'userFirstName' => $request->userFirstName,
            'userLastName' => $request->userLastName,
            'userMiddleName' => $request->userMiddleName,
            'userGender' => $request->userGender,
            'userBirthday' => $request->userBirthday,
            'userJoinDate' => $request->userJoinDate,
            'userLoginDate' => $request->userLoginDate,
            'userExpireDate' => $request->userExpireDate,
            'createBy' => $request->createBy,
            'updateBy' => $request->updatedBy,
        ]);

        // Return response
        return response()->json([
            'status' => true,
            'message' => 'Register Successfully!',
            'data' => [],
        ]);
    }

    public function login(Request $request)
    {

        $request->validate([
            'userEmail' => 'required|string|email',
            'userPassword' => 'required|string|',
        ]);

        $user = \App\Models\api\v1\user::where('userEmail', $request->userEmail)->first();

        if (!empty($user)) {

            if (Hash::check($request->userPassword, $user->userPassword)) {
                $tokenString = Str::random(255);

                $tokens = new token([
                    'userId' => $user->id,
                    'type' => '',
                    'token' => Hash::make($tokenString),
                ]);

                $tokens->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Login successful!',
                    'token' => $tokenString,
                ]);

            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid userPassword value ',
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid userEmail value ',
            ]);
        }

    }

    public function profile()
    {
        $DataUser = auth()->user();

        return response()->json([
            'status' => true,
            'message' => 'Profile Infomation',
            'data' => $DataUser,
        ]);
    }

    public function logout()
    {
        
    }
}
