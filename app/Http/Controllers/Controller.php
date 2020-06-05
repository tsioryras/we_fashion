<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Controller constructor.
     */
    public function __construct()
    {
        view()->composer('components.menu', function ($view) {
            $categoriesName = [];
            $categories = Category::all();
            foreach ($categories as $category) {
                if (Product::where('category_id', '=', $category->id)->count() > 0) {
                    $categoriesName[] = $category->name;
                }
            }
            $view->with('categories', $categoriesName);
        });
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
