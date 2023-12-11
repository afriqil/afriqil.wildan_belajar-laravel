<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function products() {
        $products = Product::get()->toArray();
        return view('admin.products.products')->with(compact('products'));
    }
}
