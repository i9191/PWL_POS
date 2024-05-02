<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index(){
        $breadcrumb = (object) [
            'title' => '',
            'list'  => ['', '']
        ];
        $activeMenu = '';

        return view('manager', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
