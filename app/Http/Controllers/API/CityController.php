<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'per_page' => 'numeric|max:25|min:1',
            'province_id' => 'numeric|exists:provinces,id',
            'search' => 'string'
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        $cities = City::query();
        $cities->orderBy('name', 'asc');
        if ($request->filled('province_id')) {
            $cities->where('province_id', $request->province_id);
        }
        if ($request->filled('search')) {
            $cities->where('name', 'like', '%' . $request->search . '%');
        }
        return CityResource::collection($cities->paginate($request->per_page));
    }

    /**
     * Display the specified resource.
     *
     * @param City $city
     * @return CityResource
     */
    public function show(City $city)
    {
        return (new CityResource($city));
    }
}
