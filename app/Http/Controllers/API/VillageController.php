<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VillageResource;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'per_page' => 'numeric|max:25|min:1',
            'district_id' => 'numeric|exists:districts,id',
            'search' => 'string'
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        $villages = Village::query();
        $villages->orderBy('name', 'asc');
        if ($request->filled('district_id')) {
            $villages->where('district_id', $request->district_id);
        }
        if ($request->filled('search')) {
            $villages->where('name', 'like', '%' . $request->search . '%');
        }
        return VillageResource::collection($villages->paginate($request->per_page));
    }

    /**
     * Display the specified resource.
     *
     * @param Village $village
     * @return VillageResource
     */
    public function show(Village $village)
    {
        return (new VillageResource($village));
    }
}
