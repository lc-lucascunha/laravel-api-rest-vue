<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->category->all();

        return response()->json($categories);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = $this->category->find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = $this->category->create([
            'name' => $request->name,
        ]);

        return response()->json($category, 201);
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = $this->category->find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Exclui todos os produtos relacionados com a categoria
        $category->products()->delete();

        // Exclui a categoria
        $category->delete();

        return response()->json(['message' => 'Category deleted']);
    }
}
