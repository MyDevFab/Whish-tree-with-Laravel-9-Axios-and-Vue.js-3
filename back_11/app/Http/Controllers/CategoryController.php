<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;

use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        //show all Categorys.
        
        $categories = Category::All();

        return  CategoryResource::collection($categories);

    }

    public function create()
    {
        //
    }


    public function store(StoreCategoryRequest $request)
    {
        // Create a Category.

        $categories = Category::create($request->all());

        return new CategoryResource($categories);
    }


    public function show($id)
    {
        // Show a Category by Tree.

        $category = Category::where('id', $id)->get();

        return response()->json($category);
    }

    public function edit(Category $category)
    {
        //
    }


    public function update(StoreCategoryRequest $request, Category $category)
    {
        // Edit a Category.

        $category->update($request->all());

        return new CategoryResource($category);
    }


    public function destroy(Category $category)
    {
        // Delete a category.

        $category->delete();

        return response(null, 204);
    }
}
