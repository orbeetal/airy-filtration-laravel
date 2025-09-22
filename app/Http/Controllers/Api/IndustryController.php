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
            ->get();

        return IndustryResource::collection($categories);
    }
}
