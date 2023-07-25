<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use Illuminate\Http\Request;

class BeerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $locale)
    {

        $beers = Beer::with(['brand.brand', 'ratings', 'translations' => function ($query) use ($locale) {
            if (!in_array($locale, config('app.available_locales'))) {
                return $query->where('is_default_locale', true);
            } else {
                return $query->where('locale', $locale);
            }
        }])
            ->latest('created_at')
            ->paginate(10);

        return compact('beers');
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
    public function show(string $id)
    {
        //
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
