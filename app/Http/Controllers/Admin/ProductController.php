<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Industry;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return
        $products = Product::query()
            ->with([
                'category:id,name',
                'industries:id,name',
            ])
            ->latest()
            ->paginate();

        return view("admin.products.index", compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();

        return view("admin.products.create", $this->getFormData($product));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;

        $product = Product::create(
            $this->getValidatedData($request)
            + $this->getPhotosData($request)
            + $this->getSpecificationData($request)
        );

        $product->industries()->sync($request->industry_ids);

        return to_route('dashboard.products.show', $product->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return to_route('dashboard.products.index', [
            'product' => $product->id, 
        ]);

        // return $product;

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // return $product;

        $product->load([
            'industries:id,name',
        ]);

        return view("admin.products.edit", $this->getFormData($product));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // return $request;

        // return $this->getValidatedData($request, $product->id);

        $product->update(
            $this->getValidatedData($request, $product->id) 
            + $this->getPhotosData($request, $product->photos)
            + $this->getSpecificationData($request, $product->specifications)
        );

        $product->industries()->sync($request->industry_ids);

        // return $product;

        return to_route('dashboard.products.show', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        return $product;

        return to_route('dashboard.products.index');
    }

    protected function getFormData($product): array
    {
        $categories = Category::query()
            ->mainCategories()
            ->with('subcategories:id,name,parent_id')
            ->get([
                'id',
                'name',
                'slug',
                'parent_id',
            ]);

        $industries = Industry::query()
            ->orderBy('order_number')
            ->get([
                'id',
                'name',
            ]);

        return compact(
            'product',
            'categories',
            'industries',
        );
    }

    protected function getValidatedData($request, $id = '')
    {
        return $request->validate([
            "name" => "required|string",
            "slug" => [
                'required',
                Rule::unique('products')->ignore($id),
            ],
            "price" => "",
            "category_id" => "required|exists:App\Models\Category,id",
            "industry_ids" => "nullable|array",
            "industry_ids.*" => "exists:App\Models\Industry,id",
            "description" => "",
            "body" => "",
        ]);
    }

    protected function getPhotosData($request, $photos = [])
    {
        if(!$request->hasFile('photos')) {
            return [];  
        }

        foreach($request->file('photos') as $index => $file) {
            $image = Image::read($file);

            $photos[$index] = $image->scale(720)->toWebp()->toDataUri();
        }

        return [
            "photos" => $photos
        ];
    }

    protected function getSpecificationData($request, $specifications = [])
    {
        if(!$request->has('specifications')) {
            return [];  
        }

        $specifications = json_decode($request->specifications, true);

        return [
            "specifications" => $specifications
        ];
    }
}
