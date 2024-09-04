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
use Illuminate\Http\JsonResponse;

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
            'userPassword' => 'required|string',
        ]);

       
        $user = \App\Models\api\v1\user::where('userEmail', $request->userEmail)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid userEmail value',
            ], 401);
        }

      
        if (!Hash::check($request->userPassword, $user->userPassword)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid userPassword value',
            ], 401);
        }

       
        $tokenString = Str::random(255); 
        $token = token::create([
            'userId' => $user->id,
            'type' => '',
            'token' => $tokenString, 
        ]);

        $token->save();

      
        return response()->json([
            'status' => true,
            'message' => 'Login successful!',
            'token' => $tokenString,
        ]);

    }

    public function profile(Request $request)
    {
        
        $tokenString = $request->bearerToken();

       
        $token = token::where('token', $tokenString)->first();

        if (!$token) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token',
            ], 401);
        }

      
        $user = \App\Models\api\v1\user::find($token->userId);

        if ($user) {
            return response()->json([
                'status' => true,
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
            ], 404);
        }

    }

    public function logout()
    {
    }

}
