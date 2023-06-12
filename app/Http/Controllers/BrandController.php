<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $locale)
    {
        $brands = Brand::with(['beers', 'translations' => function ($query) use ($locale) {
            if (!in_array($locale, config('app.available_locales'))) {
                return $query->where('is_default_locale', true);
            } else {
                return $query->where('locale', $locale);
            }
            return $query->where('locale', $locale);
        }])
            ->latest('created_at')
            ->paginate(1);

        return compact('brands');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $locale, string $id)
    {
        $brand = Brand::with('beers')
            ->with(['translations' => function ($query) use ($locale) {
                if (!in_array($locale, config('app.available_locales'))) {
                    return $query->where('is_default_locale', true);
                } else {
                    return $query->where('locale', $locale);
                }
            }])
            ->where('id', $id)
            ->get();

        return compact('brand');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
