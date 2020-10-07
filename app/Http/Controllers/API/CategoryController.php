<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
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
        $categories = Category::query();
        $categories->orderBy('name', 'asc');
        if ($request->filled('search')) {
            $categories->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $categories->where('status', $request->status);
        }
        return CategoryResource::collection($categories->paginate($request->per_page));
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category)
    {
        return (new CategoryResource($category));
    }
}
