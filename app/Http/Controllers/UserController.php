<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|min:3|max:10',
            'email' => 'required|email',
            'password' => 'required|min:8|max:200'
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        User::create($formFields);

        return 'Hello from UserController :)';
    }
}
