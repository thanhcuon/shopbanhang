<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->paginate(5);
        return response()->json($categories, 200);
    }

    public function create(Request $request)
    {
        $category = $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return response()->json($category, 201);
    }

    public function show($id)
    {
        $category = $this->category->find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($category, 200);
    }

    public function update(Request $request, $id)
    {
        $category = $this->category->find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return response()->json($category, 200);
    }

    public function destroy($id)
    {
        $category = $this->category->find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        try {
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully'], 200);
        } catch (\Exception $exception) {
            Log::error('Message:' . $exception->getMessage() . '--- Line' . $exception->getLine());
            return response()->json(['message' => 'Failed to delete category'], 500);
        }
    }
}
