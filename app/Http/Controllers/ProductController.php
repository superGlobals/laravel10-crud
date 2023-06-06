<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductValidationRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search'); 
        $perPage = 5;
        if(!empty($keyword)) {
            $products = Product::where('name', 'LIKE', "%$keyword%")->orWhere('category', 'LIKE', "%$keyword")->latest()->paginate($perPage);
        } else {
            $products = Product::latest()->paginate($perPage);
        }

        return view('products.index', compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductValidationRequest $request)
    {
        $product = new Product();

        if($request->image !== null) {

            $fileName = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $fileName);
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $fileName ?? null;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;

        $product->save();

        return redirect()->route('products.index')->with('message', 'Product added succesfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    public function update(ProductValidationRequest $request, Product $product)
    {
        $fileName = $request->hiddenProductImage;

        if($request->image !== null) {

            Product::deleteOldImage($fileName);

            $fileName = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $fileName);
        }

        $product = Product::find($request->hiddenId);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $fileName ?? null;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;

        $product->save();

        return redirect()->route('products.index')->with('message', 'Product updated succesfully');
    }

    public function destroy($id) 
    {
        $product = Product::findOrFail($id);
        
        Product::deleteOldImage($product->image);

        $product->delete();

        return redirect()->route('products.index')->with('message', 'Product deleted succesfully');
    }
}
