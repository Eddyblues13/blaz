<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Attempt to authenticate the user
            if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
                $request->session()->regenerate();

                return response()->json([
                    'success' => true,
                    'message' => 'Login successful!',
                    'redirect' => route('dashboard')
                ]);
            }

            // If authentication fails
            return response()->json([
                'success' => false,
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => [trans('auth.failed')]
                ]
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during login. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
