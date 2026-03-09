<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $products = products::orderBy('created_at', 'desc')->get();
       return view('products.index', ['products' => $products]);
    }
      public function create()
    {
        return view('products.create');
    }
      public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'sku'=>'required|unique:products,sku',
            'price'=>'required|numeric',
            'status'=>'required',
            'image'=>'image|mimes:jpg,jpeg,png|max:2048',
            ]);
        if($validator->fails()){
            return redirect(route('products.create'))->withErrors($validator)->withInput();
        }
        $product = new products();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->save();

       if ($request->hasFile('image')) {
      $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/products'), $imageName);
        $product->image = $imageName;
        $product->save();
    }

  return redirect(route('products.index'))->with('success', 'Product created successfully');
    }
     public function edit($id)
    {
       $product = products::findOrFail($id);
       return view('products.edit', ['product' => $product]);
    }

       public function update($id, Request $request)
{
    $product  = products::findOrFail($id);
    $oldImage = $product->image;

    $validator = Validator::make($request->all(), [
        'name'   => 'required',
        'sku'    => 'required|unique:products,sku,' . $id,
        'price'  => 'required|numeric',
        'status' => 'required',
        'image'  => 'image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect(route('products.edit', $product->id))->withErrors($validator)->withInput();
    }

    $product->name   = $request->name;
    $product->sku    = $request->sku;
    $product->price  = $request->price;
    $product->status = $request->status;
    $product->save();

    if ($request->hasFile('image')) {
        if ($oldImage != null && File::exists(public_path('uploads/products/' . $oldImage))) {
            File::delete(public_path('uploads/products/' . $oldImage));
        }
        $image     = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/products'), $imageName);
        $product->image = $imageName;
        $product->save();
    }

    return redirect(route('products.index'))->with('success', 'Product updated successfully');
}


        public function destroy($id)
{
    $product = products::findOrFail($id);

    if ($product->image != null && File::exists(public_path('uploads/products/' . $product->image))) {
        File::delete(public_path('uploads/products/' . $product->image));
    }

    $product->delete();

    return redirect(route('products.index'))->with('success', 'Product deleted successfully.');
}
}
