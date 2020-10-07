<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubcategoryResource;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;

class SubcategoryController extends Controller
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
            'search' => 'string'
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        $subcategories = Subcategory::query();
        $subcategories->orderBy('name', 'asc');
        if ($request->filled('search')) {
            $subcategories->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $subcategories->where('status', $request->status);
        }
        return SubcategoryResource::collection($subcategories->paginate($request->per_page));
    }

    /**
     * Display the specified resource.
     *
     * @param Subcategory $subcategory
     * @return SubcategoryResource
     */
    public function show(Subcategory $subcategory)
    {
        return (new SubcategoryResource($subcategory));
    }
}
