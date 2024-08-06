<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('admin.dashboard');

    }

    public function profile(Request $request)
    {
        return view('admin.profile');

    }
    public function updateProfile(Request $request)  {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:250', 'string'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 422);
        }
        try {
            $user = Admin::find(Auth::user()->id);
            $user->name = $request->name;
            if ($user->save()) {
                $result = ['message' => 'Profile Update successfully.', 'status' => true];
                return response()->json($result, 200);
            } else {
                $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                return response()->json($result, 200);
            }
        } catch (\Throwable$e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response()->json($result, 200);
        }
    }

    public function changePassword(Request $request)  {
        return view('admin.change-password');
    }

    public function updateChangePassword(Request $request)
    {
        try {

            $rules = [
                'old_password' => [
                    'required'
                ],
                'password' => [
                    'required',
                    'min:8',
                    'regex:/^(?!.*\s)(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                ],
                'confirm_password' => [
                    'required',
                    'min:8',
                    'regex:/^(?!.*\s)(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                    'same:password'
                ],
            ];
            
            $messages = [
                'old_password.required' => 'The old password is required.',
                'password.required' => 'The password is required.',
                'password.min' => 'The password must be at least 8 characters long.',
                'password.regex' => 'Password should be a minimum of 8 characters long, containing at least one lowercase letter, one uppercase letter, one number, and one special character (excluding spaces).',
                'confirm_password.required' => 'The new confirm password is required.',
                'confirm_password.min' => 'The new confirm password must be at least 8 characters long.',
                'confirm_password.regex' => 'Password should be a minimum of 8 characters long, containing at least one lowercase letter, one uppercase letter, one number, and one special character (excluding spaces).',
                'confirm_password.same' => 'The new confirm password must match the new password.',
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
            
            if ($validator->fails()) {
                $errors = $validator->errors();
                $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
                return response()->json($result, 200);
            }

            $user = Admin::findOrFail(Auth::user()->id);
            if (Hash::check($request->old_password, $user->password)) {
                if ($request->password == $request->confirm_password) {
                    $input['password'] = Hash::make($request->password);
                    if ($user->update($input)) {
                        $result = ['message' => 'Password Update successfully.', 'status' => true];
                        return response()->json($result, 200);
                    } else {
                        $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                        return response()->json($result, 200);
                    }
                } else {
                    $result = ['message' => '','errors' => ['confirm_password' => ['Confirm Password Doesnot Match.']], 'status' => 'validator_error'];
                    return response()->json($result, 200);
                }
            } else {
                $result = ['message' => '', 'errors' => ['old_password' => ['Old Password Does not match.']], 'status' => 'validator_error'];
                return response()->json($result, 200);
            }
        } catch (\Throwable $th) {
            $result = ['message' => $th->getMessage(), 'status' => false];
            return response()->json($result, 200);
        }
    }
}
