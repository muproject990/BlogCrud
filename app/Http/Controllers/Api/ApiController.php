<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ApiController extends Controller
{
    public function showRegisterPage(Request $request)
    {
        return view("auth.register");
    }

    public function register(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "email" => "required|string|email|unique:users",
            "password" => "required|confirmed"
        ]);

        $newUser = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);

        if (!$newUser) {
            return redirect()->back()->with('error', 'There was a problem registering the user');
        }

        return redirect()->route('showLoginPage')->with('success', 'User Registered Successfully');
    }

    public function showLoginPage()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        // Validation
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Create access token
        $token = $user->createToken('Personal Access Token')->accessToken;

        return redirect()->route('blogs.index')->with([
            'user' => $user,
            'token' => $token,
        ]);

    }

    public function profile()
    {
        $user = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "User profile data",
            "user" => $user
        ]);
    }

    public function refreshToken()
    {
        $user = request()->user();
        $token = $user->createToken("newToken");
        $refreshToken = $token->accessToken;

        return response()->json([
            "status" => true,
            "message" => "Refresh token",
            "token" => $refreshToken
        ]);
    }

    public function logout()
    {
        request()->user()->tokens()->delete();

        return response()->json([
            "status" => true,
            "message" => "User logged out"
        ]);
    }
}