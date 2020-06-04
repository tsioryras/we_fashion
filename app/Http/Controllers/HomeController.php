<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::paginate(6);
        return view('Home.index', ['products' => $products]);
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function byCategory($slug)
    {
        $category = Category::where('name', '=', $slug)->first();
        $products = Product::where('category_id', '=', $category->id)->paginate(6);
        return view('Home.index', ['products' => $products]);
    }

    /**
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function byCode($slug = "onSale")
    {
        $products = Product::where('code', '=', $slug)->paginate(6);
        return view('Home.index', ['products' => $products]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('Home.show', ['product' => $product]);
    }
}
