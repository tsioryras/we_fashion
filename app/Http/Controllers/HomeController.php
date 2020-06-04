<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;

class HomeController extends Controller
{

    public function index()
    {
        $products = Product::paginate(6);
        return view('Home.index', ['products' => $products]);
    }

    public function byCategory($slug)
    {
        $category = Category::where('name', '=', $slug)->first();
        $products = Product::where('category_id', '=', $category->id)->paginate(6);
        return view('Home.index', ['products' => $products]);
    }

    public function show($id){
        $product = Product::find($id);
        return view('Home.show', ['products' => $product]);
    }
}
