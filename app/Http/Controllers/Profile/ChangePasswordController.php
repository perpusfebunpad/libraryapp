<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordModificationRequest;
use App\Models\User;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        return view("profile.change-password");
    }

    public function update(PasswordModificationRequest $request)
    {
        $data = $request->validated();
        dd($data);
    }
}
