<?php

namespace App\Http\Controllers;

use App\Category;
use App\Picture;
use App\Product;
use Illuminate\Http\Request;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    private $pictureFolder;

    /**
     * ProductController constructor.
     * @param $pictureFolder
     */
    public function __construct()
    {
        $this->pictureFolder = public_path('storage/img/products/');
    }

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
            'description' => 'required|min:5',
            'reference' => 'required|min:5|max:16',
            'category' => 'required',
            'size' => 'required',
            'code' => 'required',
            'status' => 'required',
            'product_picture' => 'image',
            'price' => 'numeric|required'
        ]);

        $product = Product::create($request->all());
        $category = Category::find($request->input('category'));
        $product->category()->associate($category);

        if ($request->file('product_picture') != null) {
            $newFile = $request->file('product_picture')->getPathname();
            $originalName = $request->file('product_picture')->getClientOriginalName();
            $fileExtension = explode(".", $originalName)[1];
            $newFileName = substr(str_replace(' ', '', $product->id . $product->reference), 0, 20);
            $pictureLink = $newFileName . "." . $fileExtension;

            $picture = new Picture();
            trim(str_replace([" ", ".", "/", "'", "~"], "", $newFileName));
            $picture->link = $pictureLink;
            $picture->name = $request->input('name') . "_image";
            copy($newFile, $this->pictureFolder . $category->name . '/' . $pictureLink);

            $picture->category()->associate($category);
            $picture->product()->associate($product);
            $picture->save();
        }
        $product->save();
        return redirect()->route('products.index')->with('message', 'Le produit ' . strtoupper($product->name) . ' a bien été créé');
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
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
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
        $product->update($request->all());
        $category = Category::find($request->input('category'));
        //updating category
        if ($product->category_id != $request->input('category')) {
            $product->category()->dissociate();
            $product->category()->associate($category);
        }

        //updating picture
        $picture = $product->picture;
        if ($request->file('product_picture') != null) {

            $newFile = $request->file('product_picture')->getPathname();
            $originalName = $request->file('product_picture')->getClientOriginalName();
            $fileExtension = explode(".", $originalName)[1];
            $newFileName = substr(str_replace(' ', '', $product->id . $product->reference), 0, 20);
            $pictureLink = $newFileName . "." . $fileExtension;

            if ($picture == null) {
                $picture = new Picture();
            } else {
                if (file_exists($this->pictureFolder . $category->name . '/' . $picture->link) && !is_dir($this->pictureFolder . $category->name . '/' . $picture->link)) {
                    unlink($this->pictureFolder . $category->name . '/' . $picture->link);
                }
            }

            trim(str_replace([" ", ".", "/", "'", "~"], "", $newFileName));
            $picture->link = $pictureLink;
            $picture->name = $request->input('name') . "_image";
            copy($newFile, $this->pictureFolder . $category->name . '/' . $pictureLink);

            $picture->category()->associate($category);
            $picture->product()->associate($product);
            $picture->save();
        }

        if ($picture != null && $request->input('picture_src') == null) {
            $picture->product()->dissociate();
            $picture->category()->dissociate();
            $image = $this->pictureFolder . $product->category->name . '/' . $picture->link;
            if (file_exists($image) && !is_dir($image)) {
                unlink($this->pictureFolder . $category->name . '/' . $picture->link);
            }
            $picture->delete();
        }

        $product->save();
        return redirect()->route('products.index')->with('message', 'Le produit ' . strtoupper($product->name) . ' a bien été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $name = strtoupper($product->name);
        $picture = $product->picture;

        if ($picture != null) {
            $image = $this->pictureFolder . $product->category->name . '/' . $picture->link;
            if (file_exists($image) && !is_dir($image)) {
                $picture->product()->dissociate();
                unlink($image);
                $picture->delete();
            }
        }
        $product->category()->dissociate();
        $product->delete();

        return redirect()->route('products.index')->with('message', 'Le produit ' . strtoupper($name) . ' a été supprimé');
    }
}
