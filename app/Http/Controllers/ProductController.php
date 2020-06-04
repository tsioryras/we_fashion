<?php

namespace App\Http\Controllers;

use App\Category;
use App\Picture;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('Admin.Product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Admin.Product._form', ['categories' => $categories]);
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
            'name' => 'required|min:5|max:100',
            'description' => 'required',
            'size' => 'required',
            'product_picture' => 'image',
            'price' => 'numeric|deci'
        ]);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('Admin.Product._form', ['categories' => $categories, 'product' => $product]);
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
            'name' => 'required|min:5|max:100',
            'description' => 'required',
            'size' => 'required',
            'code' => 'required',
            'status' => 'required',
            'product_picture' => 'image',
            'price' => 'numeric'
        ]);

        $product = Product::find($id);
        $category = Category::find($request->input('category'));
        //updating category
        if ($product->category_id != $request->input('category')) {
            $product->category()->dissociate();
            $product->category()->associate($category);
        }

        //updating picture
        $picture = $product->picture;
        $productsPicturesFolder = public_path('storage/img/products/');
        if ($request->file('product_picture') != null) {
            $newFile = $request->file('product_picture')->getPathname();
            $originalName = $request->file('product_picture')->getClientOriginalName();
            $fileExtension = explode(".", $originalName)[1];
            $newFileName = substr(Hash::make($product->name), 0, 20);

            if ($picture != null) {
                if ($picture->category_id != $request->input('category')) {
                    $picture->category()->dissociate();
                }
            } else {
                $picture = new Picture();
            }

            if (file_exists($productsPicturesFolder . $category->name . '/' . $picture->link) && !is_dir($productsPicturesFolder . $category->name . '/' . $picture->link)) {
                unlink($productsPicturesFolder . $category->name . '/' . $picture->link);
            }
            trim(str_replace([" ", ".", "/", "'", "~"], "", $newFileName));
            $picture->link = $newFileName . "." . $fileExtension;
            $picture->name = $product->name . "_image";
            copy($newFile, $productsPicturesFolder . $category->name . '/' . $picture->link);

            $picture->category()->associate($category);
            $picture->product()->associate($product);
            $picture->save();
        } else {
            if ($picture != null) {
                $picture->product()->dissociate();
                $picture->category()->dissociate();
                $picture->delete();
                unlink($productsPicturesFolder . $category->name . '/' . $picture->link);
            }
        }

        $product->update($request->all());
        // $product->save();
        return redirect()->route('products.index')->with('message', 'Le produit ' . $product->name . ' a bien été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
