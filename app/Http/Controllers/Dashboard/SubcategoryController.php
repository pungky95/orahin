<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:34 PM
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Traits\Authorizable;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class SubcategoryController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('dashboard.subcategory.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function list(Request $request)
    {
        return Laratables::recordsOf(Subcategory::class, function ($query) use ($request) {
            $query = $query->leftJoin('categories as c', 'c.id', 'subcategories.category_id')
                ->select('subcategories.*')->whereNull('c.deleted_at');
            if ($request->filled('status')) {
                if ($request->status == 'Active' || $request->status == 'Inactive') {
                    $query->where('subcategories.status', $request->status);
                }
            }
            if ($request->filled('category_id')) {
                $query->whereCategoryId($request->category_id);
            }
            return $query;
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('dashboard.subcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image',
            'name' => 'required|max:250|unique:sub_categories,name,NULL,id,deleted_at,NULL',
        ]);
        DB::transaction(function () use ($request) {
            $requestData = $request->all();
            $subcategory = Subcategory::create($requestData);
            Log::info('CreateSub Category : ' . $subcategory);
        });
        return redirect()->route('subcategory.index')->with('success', 'Subcategory added');
    }

    /**
     * Display the specified resource.
     *
     * @param Subcategory $subcategory
     * @return array|string
     * @throws Throwable
     */
    public function show(Subcategory $subcategory)
    {
        return view('dashboard.subcategory.show', compact('subcategory'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Subcategory $subcategory
     * @return Factory|View
     */
    public function edit(Subcategory $subcategory)
    {
        return view('dashboard.subcategory.edit', compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Subcategory $subcategory
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $this->validate($request, [
            'category_id' => 'required|exists:categories,id',
            'image' => 'image',
            'name' => 'required|max:250|unique:sub_categories,name,' . $subcategory->id, 'id,deleted_at,NULL',
        ]);
        DB::transaction(function () use ($request, $subcategory) {
            $requestData = $request->all();
            Log::info('Before update Subcategory : ' . $subcategory);
            $subcategory->update($requestData);
            Log::info('After update sub Category : ' . $subcategory);
        });
        return redirect()->route('subcategory.index')->with('success', 'Subcategory updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Subcategory $subcategory
     * @return RedirectResponse
     */
    public function updateStatus(Request $request, Subcategory $subcategory)
    {
        DB::transaction(function () use ($subcategory) {
            $requestData['status'] = 'Active';
            if ($subcategory->status == 'Active') {
                $requestData['status'] = 'Inactive';
            }
            Log::info('Before update Subcategory : ' . $subcategory);
            $subcategory->update($requestData);
            Log::info('After update sub Category : ' . $subcategory);
        });
        return redirect()->route('subcategory.index')->with('success', 'Subcategory updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subcategory $subcategory
     * @return RedirectResponse
     */
    public function destroy(Subcategory $subcategory)
    {
        DB::transaction(function () use ($subcategory) {
            Log::info('Delete Subcategory : ' . $subcategory);
            $subcategory->delete();
        });
        return redirect()->route('subcategory.index')->with('success-sweetalert', 'Subcategory deleted');
    }
}
