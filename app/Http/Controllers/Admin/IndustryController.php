<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class IndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return
        $industries = Industry::query()
            ->withCount([
                'products',
            ])
            // ->latest()
            ->get();

        return view("admin.industries.index", compact('industries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $industry = new Industry();

        return view("admin.industries.create", compact('industry'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;

        $industry = Industry::create(
            $this->getValidatedData($request)
        );

        return to_route('dashboard.industries.index', [
                'industry' => $industry->id
            ])
            ->with([
                'message' => 'Data created successfully.',
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Industry $industry)
    {
        return to_route('dashboard.industries.index', [
            'industry' => $industry->id, 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Industry $industry)
    {
        return view("admin.industries.edit", compact('industry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Industry $industry)
    {
        // return $request;

        // return $this->getValidatedData($request, $industry->id);

        $industry->update(
            $this->getValidatedData($request, $industry->id)
        );

        // return $industry;

        return to_route('dashboard.industries.index', [
                'industry' => $industry->id
            ])
            ->with([
                'message' => 'Data updated successfully.',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Industry $industry)
    {
        // return $industry;

        if($industry->products()->count() == 0) {
            $message = 'Successfully delete "' . $industry->name . '"';
            $industry->delete();
        }

        return to_route('dashboard.industries.index')->with([
            'message' => $message ?? '',
        ]);
    }

    protected function getValidatedData($request, $id = '')
    {
        return $request->validate([
            "name" => "required|string",
            "slug" => [
                'required',
                Rule::unique('industries')->ignore($id),
            ],
        ]);
    }
}
