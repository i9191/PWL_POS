<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $breadcrumb = (object) [
            'title' => '',
            'list'  => ['', '']
        ];
        $activeMenu = '';

        return view('admin', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
