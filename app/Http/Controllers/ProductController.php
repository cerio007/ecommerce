<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //Show all products
    public function index() 
    {
        $records = Product::simplePaginate(5);
        return response()->json([$records]);
    }
    // Show single Product
    // public function show(Product $product) {
    //     return view('products.show', [
    //         'product'=> $product
    //     ]);
    // }
    // Create Product
    public function create() {
        return view('products.create');
    }
    // public function upload(Request $request)
    // {
    //     $validator = Validator::make($request->all(), 
    //     [
    //         'name'=> 'required',
    //         'description' => 'required',
    //         'price' => 'required',
    //         'stock_quantity' => 'required',
    //         'category' => 'required',
    //     ]);
    //     if ($validator->fails()) {
    //         $data=[
    //             'status'=>422,
    //             'message'=> $validator->messages()
    //         ];
    //         return response()->json($data, 422);
    //     }
    //     else {
    //         $product = new Product;

    //         $product->name = $request->name;
    //         $product->description = $request->description;
    //         $product->price = $request->price;
    //         $product->stock_quantity = $request->stock_quantity;
    //         $product->category = $request->category;

    //         $product->save();
    //         $data=[
    //             'status'=> 200,
    //             'message'=> 'poduct cad'
    //         ];

    //         return response()->json($data, 200);
    //     }
    // }
    // Store Product Data
    public function upload(Request $request) {
        $formField = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock_quantity' => 'required',
            'category' => 'required',
        ]);
        Product::create($formField);

        return response()->json(['message' => 'Product created successfully']);
    }
    // Update Product Data
    public function update(Request $request, Product $product) {
        $formField = $request->validate([
            'name'=> 'required',
            'description' => 'required',
            'price'=> 'required',
            'stock-quantity' => 'required',
            'category' => 'required',
        ]);
        $formField['user_id'] = auth()->id();
        Product::create($formField);

        return redirect('/')->with('message','product updated successfully');
    }
    // Delete Product
    public function destroy(Product $product) {
        if($product->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        $product->delete();
        return redirect('/')->with('message','Product deleted successfully');
    }
}

