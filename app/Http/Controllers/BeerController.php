<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBeerFormRequest;
use App\Models\Beer;
use App\Models\BeerAddedByUser;
use App\Models\PersonalAccessToken;
use App\Models\User;
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
        $validated = $request->safe();

        $authToken = $request->bearerToken();

        if (!$authToken) {
            return response()->json(['ERROR' => 'UNAUTHORIZED'], 401);
        }

        $token = PersonalAccessToken::where('token', $authToken)->first();

        if (!$token) {
            return response()->json(['ERROR' => 'TOKEN_NOT_FOUND'], 404);
        }

        $user = User::where('id', $token->user_id)->first();

        if (!$user) {
            return response()->json(['ERROR' => 'USER_NOT_FOUND'], 404);
        }

        if ($validated) {
            try {

                DB::beginTransaction();

                $beer = Beer::create([
                    'name' => $validated['name'],
                    'country' => $validated['country'],
                    'type' => $validated['type'],
                    'color' => $validated['color'],
                    'abv' => $validated['abv'],
                    'volume_available' => $validated['volume_available'] ?? null,
                    'container_available' => $validated['container_available'] ?? null,
                    'aromas' => $validated['aromas'] ?? null,
                    'ingredients' => $validated['ingredients'] ?? null,
                    'ibu' => $validated['ibu'] ?? null,
                    'is_gluten_free' => $validated['is_gluten_free'] ?? null,
                    'is_from_abbey' => $validated['is_from_abbey'] ?? null,
                    'non_filtered' => $validated['non_filtered'] ?? null,
                    'refermented' => $validated['refermented'] ?? null,
                ]);

                $beer->save();

                $beer_added_by_user = BeerAddedByUser::create([
                    'beer_id' => $beer->id,
                    'added_by_user_id' => $user->id,
                ]);

                $beer_added_by_user->save();

                DB::commit();

                return response()->json(['SUCCESS' => 'BEER_CREATED'], 200);
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json(['ERROR' => $e->getMessage()], 404);
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
