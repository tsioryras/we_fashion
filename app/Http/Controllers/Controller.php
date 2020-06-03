<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct()
    {
        view()->composer('components.menu', function ($view) {
            $categories = Category::all();
            $view->with('categories', $categories);
        });
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
