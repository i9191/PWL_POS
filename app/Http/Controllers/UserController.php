<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $user = UserModel::where('level_id',3)->count();
        // dd($user);
        return view('user', ['data' => $user]);
    }
    public function profile($id, $name) {
        $data['id'] = $id;
        $data['name'] = $name;
        return view('user', $data);
    }
}
