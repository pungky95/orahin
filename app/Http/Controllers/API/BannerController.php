<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
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
            'search' => 'string',
            'status' => 'in:Active,Inactive',
            'start_select' => 'date|required_with_all:end_select',
            'end_select' => 'date|required_with_all:start_select'
        ]);
        $today = Carbon::now();
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        $events = Banner::query();
        if ($request->filled('search')) {
            $events->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $events->where('status', $request->status);
        }
        if ($request->filled('start_select') && $request->filled('end_select')) {
            $events->whereRaw('(end_date > "' . $request->start_select . '" AND start_date BETWEEN "' .
                $request->start_select . '" AND "' . $request->end_select . '" OR start_date < "' .
                $request->end_select .
                ' AND end_date BETWEEN ' . $request->start_select . ' AND ' . $request->end_select .
                '" OR (start_date < "' . $request->start_select . '" AND end_date > "' . $request->end_select .
                '") BETWEEN "' . $request->start_select . '" AND "' . $request->end_select . '")');
        }
        if ($request)
            return BannerResource::collection($events->paginate($request->per_page));
    }

    /**
     * Display the specified resource.
     *
     * @param Banner $event
     * @return BannerResource
     */
    public function show(Banner $event)
    {
        return (new BannerResource($event));
    }
}
