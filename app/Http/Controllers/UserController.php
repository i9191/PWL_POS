<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $user = UserModel::create([
            'username'=>'manager11',
            'nama'=>'Manager11',
            'password'=>Hash::make('12345'),
            'level_id'=>2
        ]);
        $user->username='manager12';
        $user->save();

        $user->wasChanged();
        $user->wasChanged('username');
        $user->wasChanged(['username','level_id']);
        $user->wasChanged('nama');
        dd($user->wasChanged(['nama','username']));
        
        // return view('user', ['data' => $user]);
    }
    public function profile($id, $name) {
        $data['id'] = $id;
        $data['name'] = $name;
        return view('user', $data);
    }
}
