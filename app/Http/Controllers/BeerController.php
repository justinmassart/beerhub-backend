<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBeerFormRequest;
use App\Models\Beer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function store(StoreBeerFormRequest $request)
    {

        $validated = $request->safe()->only(
            'name',
            'brand',
            'country',
            'type',
            'color',
            'abv',
            'volume_available',
            'volume_available.*',
            'container_available',
            'container_available.*',
            'aromas',
            'aromas.*',
            'ingredients',
            'ingredients.*',
            'ibu',
            'is_gluten_free',
            'is_from_abbey',
            'non_filtered',
            'refermented',
        );

        if ($validated) {
            try {
                DB::beginTransaction();

                $beer = Beer::create([
                    'name' => $validated['name'],
                    'brand' => $validated['brand'],
                    'country' => $validated['country'],
                    'type' => $validated['type'],
                    'color' => $validated['color'],
                    'abv' => $validated['abv'],
                    'volume_available' => $validated['volume_available'],
                    'container_available' => $validated['container_available'],
                    'aromas' => $validated['aromas'],
                    'ingredients' => $validated['ingredients'],
                    'ibu' => $validated['ibu'],
                    'is_gluten_free' => $validated['is_gluten_free'],
                    'is_from_abbey' => $validated['is_from_abbey'],
                    'non_filtered' => $validated['non_filtered'],
                    'refermented' => $validated['refermented'],
                ]);

                $beer->save();

                DB::commit();

                return response()->json(['SUCCESS' => 'BEER_CREATED'], 200);
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json(['ERROR' => 'COULD_NOT_CREATE_BEER'], 404);
            }
        } else {
            return response()->json(['ERROR' => 'FORM_NOT_VALID'], 404);
        }
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
