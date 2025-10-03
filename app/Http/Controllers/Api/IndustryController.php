<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IndustryResource;
use App\Models\Industry;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    public function index()
    {
        $categories = Industry::query()
            ->orderBy('order_number')
            ->get([
                'id',
                'name',
                'slug',
                'image',
            ]);

        return IndustryResource::collection($categories);
    }

    public function show($slug)
    {
        $industry = Industry::query()
            ->where('slug', $slug)
            ->first();

        return IndustryResource::make($industry);
    }

    public function streamImage($id)
    {
        $industry = Industry::select('image')->findOrFail($id);

        $imageData = $this->getImageData($industry->image);
        
        return $imageData
            ? response($imageData)->header('Content-Type', 'image/webp')
            : abort(404);
    }
}
