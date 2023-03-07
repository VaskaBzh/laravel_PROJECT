<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => ["required", "email", "string"],
            "password" => ["required", 'string'],
        ]);

        $user = User::all()->where('email', $data['email'])->first();

//        if (!auth("web")->attempt($data)) {
//            return back()->withErrors(
//                ["email" => "Неверный логин или пароль"]
//            );
//        }

//        auth("web")->login($user);

        Auth::login($user);
        return redirect()->route("profile");
    }

    public function logout() {
        auth("web")->logout();

        return redirect()->route("home");
    }

    public function remove()
    {
//        $user = User::all()->where('email', 'login@login.ru')->first();
//        $user->groups = ["MyWorker"];
//
//        $user->update();
//        dd($user);
//        $users = User::all();
//
//        foreach ($users as $user) {
//            $user->delete();
//        }
    }

}
