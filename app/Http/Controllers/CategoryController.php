<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var Category
     */
    private $category;

    public function __construct(
        Category $category
    )
    {
        $this->category  = $category;
    }

    public function index()
    {
        $categories = $this->category->all();

        return response()->json($categories);
    }

    public function show($id)
    {
        $category = $this->category->find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }

    public function store(Request $request)
    {
        $category = $this->category->create([
            'name' => $request->name,
        ]);

        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        $category = $this->category->find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->name = $request->name;
        $category->save();

        return response()->json($category);
    }

    public function destroy($id)
    {
        $category = $this->category->find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted']);
    }
}
