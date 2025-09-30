<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->with('subcategories')
            ->get();

        return CategoryResource::collection($categories);
    }

    public function show($slug)
    {
        $category = Category::query()
            ->with('subcategories')
            ->where('slug', $slug)
            ->first();

        return CategoryResource::make($category);
    }
}
