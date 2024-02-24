<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('welcome');
    }
    public function profile($id, $name) {
        $data['id'] = $id;
        $data['name'] = $name;
        return view('user', $data);
    }
}
