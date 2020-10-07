<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:34 PM
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
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

class CategoryController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('dashboard.category.index');
    }

    public function list()
    {
        return Laratables::recordsOf(Category::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('dashboard.category.create');
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
            'name' => 'required|max:250|',
            'image' => 'required|image',
        ]);
        DB::transaction(function () use ($request) {
            $category = Category::create($request->all());
            Log::info('Create Customer : ' . $category);
        });
        return redirect()->route('category.index')->with('success', 'Category added');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return array|string
     * @throws Throwable
     */
    public function show(Category $category)
    {
        return view('dashboard.category.show', compact('category'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Factory|View
     */
    public function edit(Category $category)
    {
        return view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|max:250|unique:categories,name,' . $category->id . ',id,deleted_at,NULL',
            'image' => 'required|image',
        ]);
        $requestData = $request->all();
        DB::transaction(function () use ($requestData, $category) {
            Log::info('Before update Category : ' . $category);
            $category->update($requestData);
            Log::info('After update Category : ' . $category);
        });
        return redirect()->route('category.index')->with('success', 'Category updated');
    }

    /**
     * Update the status specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function updateStatus(Category $category)
    {
        DB::transaction(function () use ($category) {
            $requestData['status'] = 'Active';
            if ($category->status == 'Active') {
                $requestData['status'] = 'Inactive';
            }
            Log::info('Before update Category : ' . $category);
            $category->update($requestData);
            Log::info('After update Category : ' . $category);
        });
        return redirect()->route('category.index')->with('success', 'Category updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category)
    {
        DB::transaction(function () use ($category) {
            Log::info('Delete Category : ' . $category);
            $category->delete();
        });
        return redirect()->route('category.index')->with('success-sweetalert', 'Category deleted');
    }
}
