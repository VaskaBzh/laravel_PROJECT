<?php

namespace App\Http\Controllers\Auth\Sub;

use App\Http\Controllers\Controller;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SubController extends Controller
{

    public function visual()
    {
        $subs = Sub::all();

//        return $subs->json();

        return response()->json([
            'status' => 'success',
            'data' => $subs,
        ]);
//        $subs = Sub::all();
//
//        return view('sub_process', compact('subs'));
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "string", "max:20", "min:3"],
//            [
//                'name.required' => 'Нужно обязательно задать имя сабаккаунту',
//                'name.min:3' => 'В имени должно быть больше 3 символов',
//                'name.max:20' => 'В имени должно быть меньше 20 символов',
//            ],

        ]);
        $user = Auth::user();
//        if (!auth("namerequired")->attempt($data)) {
//            return back()->withErrors(
//                ["name" => "Нужно обязательно задать имя сабаккаунту"]
//            );
//        }

        Sub::firstOrCreate(['name' => $data['name'], 'user' => $user], $data);
    }

    public function remove()
    {
//        $subs = Sub::all();
//
//        foreach ($subs as $sub) {
//            $sub->delete();
//        }
    }

}
