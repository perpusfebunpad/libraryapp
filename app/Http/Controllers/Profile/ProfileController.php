<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileModificationRequest;
use App\Models\User;
function getInitials($name) {
    $words = explode(' ', trim($name));
    $initials = '';

    foreach ($words as $word) {
        if (!empty($word)) {
            $initials .= strtoupper($word[0]);
        }
    }

    return $initials;
}
class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $words = explode(" ", trim($user->name));
        $initials  = strtoupper($words[0][0]);
        $words_count = count($words);
        if($words_count > 1) {
            $initials .= strtoupper($words[count($words) - 1][0]);
        }

        return view("profile.index", [
            "user" => $user,
            "initial" => $initials,
        ]);
    }

    public function edit()
    {
        $user = User::find(auth()->user()->id);
        return view("profile.edit", [
            "user" => $user,
        ]);
    }

    public function update(ProfileModificationRequest $request)
    {
        $data = $request->validated();
        User::find(auth()->user()->id)->update($data);
        return redirect(route("profile.index"))->with("success", "Profile changed");
    }
}
