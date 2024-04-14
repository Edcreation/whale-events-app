<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::where('id', $id)->first();
        return response()->json($category);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories',
            'displayName' => 'required|string|max:255|unique:categories',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $category = Category::create($request->all()); // Create a new event
        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255|unique:categories',
            'displayName' => 'string|max:255|unique:categories',
            'description' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $updateCategory = $request->only([
            'name',
            'displayName',
            'description'
        ]);

        $category->fill($updateCategory);

        $category->save();

        return response()->json($category, 200);

    }

    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        return response()->json(['message' => 'Event deleted successfully'], 200);
    }
}
