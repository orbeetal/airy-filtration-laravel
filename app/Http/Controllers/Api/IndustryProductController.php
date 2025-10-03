<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IndustryResource;
use App\Http\Resources\ProductResource;
use App\Models\Industry;
use App\Models\Product;
use Illuminate\Http\Request;

class IndustryProductController extends Controller
{
    public function industryProducts(Request $request, $industry_slug)
    {
        $skip = (int) ($request->skip ?? 0);
        $take = (int) ($request->take ?? 10);

        $industry = Industry::query()
            ->where('slug', $industry_slug)
            ->first();

        if(!$industry) {
            return [
                'total'     => 0,
                'skip'      => $skip,
                'take'      => $take,
                'industry'  => (object) [],
                'products'  => (array) [],
            ];
        }

        $query = Product::query()
            ->whereHas('industries', function ($q) use ($industry) {
                $q->where('industry_id', $industry->id);
            });

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
            'industry'  => IndustryResource::make($industry),
            'products'  => $total ? ProductResource::collection($products) : [],
        ];
    }
}
