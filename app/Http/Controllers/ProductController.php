<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return view('welcome');
    }
    public function foodProductView() {
        $data = [
            "title" => "Food & Beverage", 
            "items" => ["coffee", "salad", "juice", "cake"]
        ];
        return view('product',$data);
    }
    public function beautyhealthProductView() {
        $data = [
            "title" => "Beauty & Health", 
            "items" => ["shampoo", "makeup", "vitamin", "perfume", "soap"]
        ];
        return view('product',$data);
    }
    public function homeProductView() {
        $data = [
            "title" => "Home Care", 
            "items" => ["detergent", "broom", "mop", "trash bag", "candle"]
        ];
        return view('product',$data);
    }
    public function babyProductView() {
        $data = [
            "title" => "Baby & Kid", 
            "items" => ["diaper", "toy", "book", "crayon", "blanket"]
        ];
        return view('product',$data);
    }
}
