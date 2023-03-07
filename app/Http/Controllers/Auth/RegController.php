<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\User\CodeEmail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;



class RegController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            "email" => ['unique:users', 'email', 'required'],
            "code" => '',
            "name" => ['string'],
            "password" => ['string', 'min:6']
        ]);

        $user = User::firstOrCreate([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => Hash::make($data['password'])
        ]);
        Auth::login($user);

        return redirect()->route("profile");
    }

    public function get(Request $request)
    {
        return User::all()->where("email", $request->email);
    }

    public function code(Request $request)
    {
        $data = $request->validate([
            "email" => ['unique:users', 'email', 'required', 'max:255'],
        ]);
        $code = Str::random(10);
//        Mail::to($data['email'])->send(new CodeEmail($code));
        return $code;
    }

    public function remove()
    {
        $users = User::all();

        foreach ($users as $user) {
            if ($user->email != "admin@admin.ru") {
                $user->delete();
            }
        }
    }

}
