<?php

namespace App\Http\Controllers\Subs;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SubController extends Controller
{

    public function create(Request $request)
    {
        $data = $request->validate([
            "group_name" => ['string', 'min:3'],
        ]);

        $user = User::all()->find(Auth::user()->id);

        $groups = Array($data['group_name']);

        if ($user->groups != "" || $user->groups != null) {
            foreach ($user->groups as $worker) {
                if ($data['group_name'] != $worker) {
                    array_push($groups, $worker);
                }
            }
        }

        $user->groups = $groups;

        $user->update();
//        return $groups;

        return $user;
    }

    public function visual()
    {
        return User::all()->find(Auth::user()->id)->groups;
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            "group_name" => ['string', 'min:3'],
        ]);

        $user = User::all()->find(Auth::user()->id);

        $groups = [];

        if (count($user->groups) != 0) {
            for ($i = 0; $i < count($user->groups); $i++) {
                if ($data['group_name'] != $user->groups[$i]) {
                    array_push($groups, $user->groups[$i]);
                }
            }
        }
        $user->groups = [];
        $user->update();

        return $user;
    }

    public function delete()
    {
        $user = User::all()->find(Auth::user()->id);

        $user->groups = [];
        $user->update();

        return $user;
    }

}
