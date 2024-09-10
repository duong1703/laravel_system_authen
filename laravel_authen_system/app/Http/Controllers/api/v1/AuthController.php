<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\api\v1\token;
use Auth;
use DB;
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


        $user = \App\Models\api\v1\User::where('userEmail', $request->userEmail)->first();

        if (!$user || !Hash::check($request->userPassword, $user->userPassword)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }


        $tokenString = Str::random(60);


        $token = Token::create([
            'userId' => $user->id,
            'token' => $tokenString,
            'type' => 'access',
        ]);

        // Trả về token
        return response()->json([
            'status' => true,
            'message' => 'Login successful!',
            'token' => $tokenString,
        ]);
    }

    public function profile(Request $request)
    {
        $user = $request->get('user');

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User Unauthorize!',
            ], 401);
        }

        // Trả về thông tin người dùng
        return response()->json([
            'status' => true,
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $tokenString = $request->bearerToken();

        if (!$tokenString) {
            return response()->json([
                'status' => false,
                'message' => 'Token not register!',
            ], 400);
        }

        $token = DB::table('token')->where('token', $tokenString)->first();

        if ($token) {
            DB::table('token')->where('token', $tokenString)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Logout Successfully!',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid Token!',
        ], 400);
    }

}
