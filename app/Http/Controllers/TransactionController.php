<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index() {
        return view('welcome');
    }
    public function transactionView() {
        $categories = [
            "food-beverage" => ["pizza", "coffee", "salad", "juice", "cake"],
            "beauty-health" => ["shampoo", "makeup", "vitamin", "perfume", "soap"],
            "home-care" => ["detergent", "broom", "mop", "trash bag", "candle"],
            "baby-kid" => ["diaper", "toy", "book", "crayon", "blanket"]
        ];
        $data['transactions'] = [];
        // random data
        for ($i = 0; $i < 10; $i++) {
            $category = array_rand($categories);
            $product = array_rand($categories[$category]);
            $quantity = rand(1, 5);
            $data['transactions'][] = [
                "category" => $category,
                "product" => $categories[$category][$product],
                "quantity" => $quantity
            ];
        }
        return view('transaction',$data);
    }
}
