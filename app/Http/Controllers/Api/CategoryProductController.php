<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function categoryProducts(Request $request, $category_slug)
    {
        $skip = (int) ($request->skip ?? 0);
        $take = (int) ($request->take ?? 10);

        $category = Category::query()
            ->where('slug', $category_slug)
            ->first();

        if(!$category) {
            return [
                'total'     => 0,
                'skip'      => $skip,
                'take'      => $take,
                'category'  => (object) [],
                'products'  => (array) [],
            ];
        }

        $category_ids = $category->parent_id === 0
            ? $category->subcategories()->pluck('id')->push($category->id)->toArray()
            : [$category->id];

        $query = Product::query()
            ->whereIn('category_id', $category_ids);

        $total = $query->count();

        if($total > 0) {
            // return
            $products = $query
                ->select([
                    'id', 
                    'slug',
                    'name',
                    'photos',
                    'description',
                ])
                ->skip($skip)
                ->take($take)
                ->get();
        }

        return [
            'total'     => $total,
            'skip'      => $skip,
            'take'      => $take,
            'category'  => CategoryResource::make($category),
            'products'  => $total ? ProductResource::collection($products) : [],
        ];
    }
}
