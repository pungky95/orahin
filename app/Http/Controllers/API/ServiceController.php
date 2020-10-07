<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Models\ServiceMedia;
use App\Models\Vendor;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
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
            'search' => 'nullable|string',
            'vendor_id' => 'nullable|numeric|exists:vendors,id',
            'category_id' => 'nullable|numeric|exists:categories,id',
            'subcategory_id' => 'nullable|numeric|exists:subcategories,id',
            'start_price' => 'nullable|numeric|min:1|required_with:end_price',
            'end_price' => 'nullable|numeric|required_with:start_price',
            'latitude' => 'nullable|numeric|required_with:longitude',
            'longitude' => 'nullable|numeric|required_with:latitude',
            'distance' => 'nullable|numeric',
            'sort_by' => 'nullable|in:price,updated_at|required_with:order_by',
            'order_by' => 'nullable|in:asc,desc|required_with:order_by'
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        $services = Service::query();
        $services->where('status', 'Published');
        $services->whereHas('vendor', function (Builder $query) {
            $query->whereNull('deleted_at')->where('id_card_verified', 'Verified');
        });
        if ($request->filled('search')) {
            $services->where('services.name', 'like', '%' . $request->search . '%');
        }
        if ($request->has('vendor_id')) {
            $services->whereHas('vendor', function (Builder $query) use ($request) {
                $query->where('id', $request->vendor_id);
            });
        }
        if ($request->has('category_id')) {
            $services->whereHas('categories', function (Builder $query) use ($request) {
                $query->where('id', $request->category_id);
            });
        }
        if ($request->has('subcategory_id')) {
            $services->whereHas('subcategories', function (Builder $query) use ($request) {
                $query->where('id', $request->subcategory_id);
            });
        }
        if ($request->filled('start_price') && $request->filled('end_price')) {
            $services->where('price', '>=', $request->start_price)->where('price', '<=', $request->end_price);
        }
        if ($request->has('latitude') && $request->has('longitude')) {
            $sqlDistance = DB::raw('round(( 111.045 * acos( cos( radians(' . $request->latitude . ') )
                * cos( radians( latitude ) )
                * cos( radians( longitude )
                - radians(' . $request->longitude . ') )
                + sin( radians(' . $request->latitude . ') )
                * sin( radians( latitude ) ) ) ),2)');
            $services->selectRaw("services.id,services.vendor_id,services.name,services.description,services.price,services.unit,services.quantity,services.updated_at,services.created_at,{$sqlDistance} AS distance")->leftJoin('vendors', 'vendors.id', 'services.vendor_id')
                ->leftJoin('vendor_addresses', 'vendor_addresses.vendor_id', 'vendors.id')
                ->orderBy('distance', 'asc');
            if ($request->filled('distance')) {
                $services->having('distance', '<=', $request->distance);
            }
        }
        if ($request->filled('sort_by') && $request->filled('order_by')) {
            $services->orderBy($request->sort_by, $request->order_by);
        }
        return ServiceResource::collection($services->simplePaginate($request->per_page));
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
            'images' => 'array|required',
            'images.*' => 'image',
            'name' => 'required|string|max:250',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'unit' => 'required|in:Hour,Day,Quantity',
            'quantity' => 'required|numeric|min:1',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'nullable|numeric|exists:categories,id',
            'subcategory_ids' => 'nullable|array',
            'subcategory_ids.*' => 'nullable|numeric|exists:categories,id'
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        $requestData = $request->all();
        $vendor = Vendor::where('customer_uid', $request->user()->uid)->first();
        if (!$vendor) {
            return errorResponse('Anda tidak dapat membuat jasa karena anda belum mendaftar sebagai Vendor!', 403);
        }
        if ($vendor->id_card_verified != 'Verified') {
            return errorResponse('Vendor anda belum terverifikasi', 403);
        }
        $requestData['vendor_id'] = $vendor->id;
        DB::beginTransaction();
        try {
            $service = Service::create($requestData);
            Log::info('Create Service : ' . $service);
            $order = 0;
            if ($request->filled('category_ids')) {
                $service->categories()->sync($request['category_ids']);
            }
            if ($request->filled('subcategory_ids')) {
                $service->subcategories()->sync($request['subcategory_ids']);
            }
            if ($requestData['images']) {
                foreach ($requestData['images'] as $image) {
                    $serviceMedias = new ServiceMedia(['image' => $image, 'order' => $order]);
                    $service->serviceMedias()->save($serviceMedias);
                    $order++;
                }
                Log::info('Create Service Media : ' . $service->serviceMedias);
            }
            DB::commit();
            return new ServiceResource($service);
        } catch (Exception $e) {
            DB::rollBack();
            return errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Service $service
     * @return ServiceResource
     */
    public function show(Service $service)
    {
        return new ServiceResource($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Service $service
     * @return ServiceResource
     */
    public function update(Request $request, Service $service)
    {
        $validator = Validator::make($request->all(), [
            'images' => 'array',
            'images.*' => 'image',
            'name' => 'required|string|max:250',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'unit' => 'required|in:Hour,Day,Quantity',
            'quantity' => 'required|numeric|min:1',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'nullable|numeric|exists:categories,id',
            'subcategory_ids' => 'nullable|array',
            'subcategory_ids.*' => 'nullable|numeric|exists:categories,id'
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        $requestData = $request->all();
        $vendor = Vendor::where('customer_uid', $request->user()->uid)->first();
        if (!$vendor) {
            return errorResponse('Anda tidak dapat membuat jasa karena anda belum mendaftar sebagai Vendor!', 403);
        }
        if ($vendor->id_card_verified != 'Verified') {
            return errorResponse('Vendor anda belum terverifikasi', 403);
        }
        $requestData['vendor_id'] = $vendor->id;
        DB::beginTransaction();
        try {
            Log::info('Before update Service : ' . $service);
            $service->update($requestData);
            Log::info('After update Service : ' . $service);
            if ($request->filled('category_ids')) {
                $service->categories()->sync($request['category_ids']);
            }
            if ($request->filled('subcategory_ids')) {
                $service->subcategories()->sync($request['subcategory_ids']);
            }
            if ($requestData['images']) {
                Log::info('Before update Service Media : ' . $service->serviceMedias);
                $order = 1;
                $service->serviceMedias()->delete();
                foreach ($requestData['images'] as $image) {
                    $serviceMedias = new ServiceMedia(['image' => $image, 'order' => $order]);
                    $service->serviceMedias()->save($serviceMedias);
                    $order++;
                }
                Log::info('After update Service Media : ' . $service->serviceMedias);
                $service->refresh();
            }
            DB::commit();
            return new ServiceResource($service);
        } catch (Exception $e) {
            DB::rollBack();
            return errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Service $service
     * @return JsonResponse|void
     */
    public function destroy(Service $service)
    {
        DB::beginTransaction();
        try {
            Log::info('Delete Service Media : ' . $service->serviceMedias);
            $service->serviceMedias()->delete();
            Log::info('Delete Service : ' . $service);
            $service->delete();
            DB::commit();
            return successResponse('Layanan berhasil dihapus');
        } catch (Exception $e) {
            DB::rollBack();
            return errorResponse($e->getMessage(), 500);
        }
    }

    public function updateImages(Service $service, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'images' => 'required|array',
            'images.*' => 'image',
        ]);
        if ($validator->fails()) {
            return errorResponse($validator->errors(), 400);
        }
        $requestData = $request->all();
        $vendor = Vendor::where('customer_uid', $request->user()->uid)->first();
        if (!$vendor) {
            return errorResponse('Anda tidak dapat membuat jasa karena anda belum mendaftar sebagai Vendor!', 403);
        }
        if ($vendor->id_card_verified != 'Verified') {
            return errorResponse('Vendor anda belum terverifikasi', 403);
        }
        DB::beginTransaction();
        try {
            if ($requestData['images']) {
                Log::info('Before update Service Media : ' . $service->serviceMedias);
                $order = 1;
                $service->serviceMedias()->delete();
                foreach ($requestData['images'] as $image) {
                    $serviceMedias = new ServiceMedia(['image' => $image, 'order' => $order]);
                    $service->serviceMedias()->save($serviceMedias);
                    $order++;
                }
                Log::info('After update Service Media : ' . $service->serviceMedias);
                $service = Service::find($service->id);
            }
            DB::commit();
            return new ServiceResource($service);
        } catch (Exception $e) {
            DB::rollBack();
            return errorResponse($e->getMessage(), 500);
        }
    }
}
