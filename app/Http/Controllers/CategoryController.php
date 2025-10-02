<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = category::all();
        return view("pages.categories",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("pages.create_category");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name" =>"required|string|min:3|max:255|regex:/^[A-Za-z\s]+$/",
            "description" => "nullable|string|max:255",
            "status" => "nullable|in:active,inactive"
        ]);
        $data = $request->only("name","description","status");
        try{
        category::create($data);
        return redirect()->route("categories.index")->with("success","category is added successfully");
        }catch(\Exception $e){
            return redirect()->back()->withInput()->with("error"," failed to add category, try again");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        //
        return view("pages.edit_category",compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        //
        $request->validate([
            "name" =>"required|string|min:3|max:255|regex:/^[A-Za-z\s]+$/",
            "description" => "nullable|string|max:255",
            "status" => "nullable|in:active,inactive"
        ]);
          $data = $request->only("name","description","status");
        try{
            $category->update($data);
            return redirect()->route("categories.index")->with("success","category is updated successfully");
        }catch(\Exception $e){
            return redirect()->back()->withInput()->with("error","failed");

        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        //
        $category->delete();
        return redirect()->route("categories.index")->with("success","category is deleted successfully");

    }
}
