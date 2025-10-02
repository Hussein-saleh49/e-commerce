<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Product;
use Illuminate\Http\Request;

use function PHPUnit\Framework\fileExists;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all();
        return view("pages.products",compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = category::all();
        return view("pages.addproduct",compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        //
        $request->validate([
            "product_name" => "required|string|max:255",
            "price" => "required|numeric",
            "stock" => "required|integer",
            "image" => "nullable|image|mimes:jpeg,png,jpg",
            "status" => "required|in:available,out_of_stock",
            "category_id" => "required|exists:categories,id"
        ]);
        $product_name = $request->product_name;
        $price = $request->price;
        $stock = $request->stock;
        $status = $request->status;
        $category_id = $request->category_id;
        //
        $image_name = null;

    if($request->hasFile('image')){
        $image = $request->file('image');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/products'), $image_name);
    }


        
        Product::create([
            "name" => $product_name,
            "price" => $price,
            "stock" => $stock,
            "image" => $image_name,
            "status" => $status,
            "category_id" => $category_id
        ]);
        return redirect()->route("products.index")->with("success","product is added successfully");
    }

    /**
     * Display the specified resource.
     */

    public function search(Request $request){

        $search = $request->search;
        $products= Product::where("name","like","%".$search."%")
        ->orwhere("status","like","%".$search."%")->get();
        return view("pages.products",compact("products"));
    }
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        return view("pages.editproduct",compact("product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $request->validate([
            "product_name" =>"required|string",
            "price" => "required|numeric|min:0",
            "stock" => "required|integer|min:0",
            "status" => "required|in:available,out_of_stock",   
            "image" => "nullable|image|mimes:jpg,png,jpeg",
        ]);
         $data = $request->only("product_name","price","stock","status");

            if($request->hasFile("image")){
                $image = $request->file("image");
                
                $image_name = time().".".$image->getClientOriginalExtension();
                $image->move(public_path("uploads/products/"),$image_name);
                if($product->image && file_exists(public_path("uploads/products/".$product->image))){
                    
                    unlink(public_path("uploads/products/". $product->image));
                }

                $data["image"] = $image_name;
            }

        $product->update($data);

        return redirect()->route("products.index")-> with("success","product is edited successfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        if($product->image &&file_exists(public_path("uploads/products/". $product->image))){
            unlink(public_path("uploads/products/".$product->image));
        }
        $product->delete();
        return redirect()->route("products.index")->with("success","product is deleted successfully");

    }
}
