<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Support\Facades\Cache;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    private $paginate = 6;
    private $cacheTime = 5;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $prefix = request()->page ?? '1';
        $path = 'home.page.' . $prefix;

        $products = Cache::remember($path, now()->addMinutes($this->cacheTime), function () {
            return Product::with('picture', 'category')->paginate($this->paginate); // pagination
        });

        $count = Cache::remember('products.count', now()->addMinutes($this->cacheTime), function () {
            return Product::all()->count();
        });

        $slug = 'accueil';

        return view('Home.index', compact('products', 'count', 'slug'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function byCategory($slug)
    {
        $prefix = request()->page ?? '1';
        $path = 'home.' . $slug . '.page.' . $prefix;

        $category = Category::where('name', '=', $slug)->first();

        $count = Cache::remember('products' . $slug . '.count', now()->addMinutes($this->cacheTime), function () use ($category) {
            return Product::where('category_id', '=', $category->id)->count();
        });

        $products = Cache::remember($path, now()->addMinutes($this->cacheTime), function () use ($category) {
            return Product::where('category_id', '=', $category->id)->with('picture', 'category')->paginate($this->paginate); // pagination
        });

        return view('Home.index', compact('products', 'count', 'slug'));
    }

    /**
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function byCode($slug = "onSale")
    {
        $prefix = request()->page ?? '1';
        $path = 'home.' . $slug . '.page.' . $prefix;

        $count = Cache::remember('products' . $slug . '.count', now()->addMinutes($this->cacheTime), function () use ($slug) {
            return Product::where('code', '=', $slug)->count();
        });

        $products = Cache::remember($path, now()->addMinutes($this->cacheTime), function () use ($slug) {
            return Product::where('code', '=', $slug)->paginate($this->paginate); // pagination
        });

        $slug = 'en solde';

        return view('Home.index', compact('products', 'count', 'slug'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('Home.show', compact('product'));
    }
}
