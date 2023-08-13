<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchInputsController extends Controller
{
    public function brands(Request $request)
    {
        $search_term = $request->query('search_term');

        if ($search_term) {
            $searchResults = Brand::search($search_term)->get();

            $brandIds = $searchResults->pluck('id')->all();

            $brands = Brand::whereIn('id', $brandIds)
                ->select('id', 'name')
                ->get();

            return compact('brands');
        } else {
            return ['brands' => []];
        }
    }

    public function beer_types()
    {
        $enumValues = Beer::distinct('type')->pluck('type');
        return response()->json($enumValues);
    }

    public function beer_colors()
    {
        $enumValues = Beer::distinct('color')->pluck('color');
        return response()->json($enumValues);
    }
}
