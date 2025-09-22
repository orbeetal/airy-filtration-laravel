<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return
        $categories = Category::query()
            ->mainCategories()
            ->with([
                'subcategories' => fn ($query) => $query->withCount('products')
            ])
            ->withCount([
                'products',
                'subcategories',
            ])
            // ->latest()
            ->get();

        return view("admin.categories.index", compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();

        return view("admin.categories.create", compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;

        $category = Category::create(
            $this->getValidatedData($request) + [
                "parent_id" => $request->parent_id ?? 0,
            ]
        );

        return to_route('dashboard.categories.index', [
                'category' => $category->id
            ])
            ->with([
                'message' => 'Data created successfully.',
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return to_route('dashboard.categories.index', [
            'category' => $category->id, 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view("admin.categories.edit", compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // return $request;

        // return $this->getValidatedData($request, $category->id);

        $category->update(
            $this->getValidatedData($request, $category->id)
        );

        // return $category;

        return to_route('dashboard.categories.index', [
                'category' => $category->id
            ])
            ->with([
                'message' => 'Data updated successfully.',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // return $category;

        if(
            $category->products()->count() == 0
            && $category->subcategories()->count() == 0
        ) {
            $message = 'Successfully delete "' . $category->name . '"';
            $category->delete();
        }

        return to_route('dashboard.categories.index')->with([
            'message' => $message ?? '',
        ]);
    }

    protected function getValidatedData($request, $id = '')
    {
        return $request->validate([
            "name" => "required|string",
            "slug" => [
                'required',
                Rule::unique('categories')->ignore($id),
            ],
        ]);
    }
}
