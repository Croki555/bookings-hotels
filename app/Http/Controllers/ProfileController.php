<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.edit', [
            'user' => auth('web')->user()
        ]);
    }

    public function verification()
    {
        return 'verification.send';
    }

    public function update()
    {
        return 'profile.update';
    }

    public function passwordUpdate()
    {
        return 'password.update';
    }

    public function deleteProfile()
    {
        return 'profile.destroy';
    }
}
