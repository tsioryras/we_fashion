<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('Admin.Category.index', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $categoryFolder = public_path('storage/img/products/' . $request->name);
        if (!file_exists($categoryFolder)) {
            mkdir($categoryFolder, 0777);
        }
        Category::create($request->all());
        return redirect()->route('categories.index')->with('message', 'catégoire ' . strtoupper($request->name) . ' créée');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = Category::find($id);
        //renommer le dossier liés à la catégorie
        $categoryOldFolder = public_path('storage/img/products/' . $category->name);
        $categoryNewFolder = public_path('storage/img/products/' . $request->name);
        if (rename($categoryOldFolder, $categoryNewFolder)) {
            $category->update($request->all());
        }

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $name = strtoupper($category->name);
        $category->delete();

        return redirect()->route('categories.index')->with('message', 'Catégorie ' . $name . ' supprimée');
    }
}
