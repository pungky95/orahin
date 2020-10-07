<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProvinceResource;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
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
            'per_page' => 'numeric|min:1|max:25',
            'search' => 'string'
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        $provinces = Province::query();
        $provinces->orderBy('name', 'asc');
        if ($request->filled('search')) {
            $provinces->where('name', 'like', '%' . $request->search . '%');
        }
        return ProvinceResource::collection($provinces->paginate($request->per_page));
    }

    /**
     * Display the specified resource.
     *
     * @param Province $province
     * @return ProvinceResource
     */
    public function show(Province $province)
    {
        return (new ProvinceResource($province));
    }
}
