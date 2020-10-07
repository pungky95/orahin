<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteItemResource;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FavoriteItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'per_page' => 'numeric|max:25|min:1',
            'search' => 'string'
        ]);
        $services = Service::leftJoin('favorite_items as fi', 'fi.service_id', 'services.id')
            ->select('services.*', 'fi.created_at as added_at')
            ->where('customer_uid', $request->user()->uid);
        if ($request->filled('search')) {
            $services->where('services.name', 'like', '%' . $request->search . '%');
        }
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        return FavoriteItemResource::collection($services->paginate($request->per_page));;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:services,id'
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        DB::beginTransaction();
        try {
            if (!$request->user()->favoriteItems->contains($request->service_id)) {
                $request->user()->favoriteItems()->attach($request->service_id);
            } else {
                return successResponse('Service telah ditambahakn ke favorite anda');
            }
            DB::commit();
            return successResponse('Service berhasil di tambahkan ke favorite anda');
        } catch (Exception $e) {
            DB::rollBack();
            return errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $service = Service::findOrFail($id);
        DB::beginTransaction();
        try {
            if ($request->user()->favoriteItems->contains($service->id)) {
                $request->user()->favoriteItems()->detach($service->id);
            } else {
                return successResponse('Service tidak ada di favorite anda');
            }
            DB::commit();
            return successResponse('Berhasil di hapus dari favorite anda');
        } catch (Exception $e) {
            DB::rollBack();
            return errorResponse($e->getMessage(), 500);
        }
    }
}
