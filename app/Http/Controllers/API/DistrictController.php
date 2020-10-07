<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
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
            'city_id' => 'numeric|exists:cities,id',
            'search' => 'string'
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        $districts = District::query();
        $districts->orderBy('name', 'asc');
        if ($request->filled('city_id')) {
            $districts->where('city_id', $request->city_id);
        }
        if ($request->filled('search')) {
            $districts->where('name', 'like', '%' . $request->search . '%');
        }
        return DistrictResource::collection($districts->paginate($request->per_page));
    }

    /**
     * Display the specified resource.
     *
     * @param District $district
     * @return DistrictResource
     */
    public function show(District $district)
    {
        return (new DistrictResource($district));
    }
}
