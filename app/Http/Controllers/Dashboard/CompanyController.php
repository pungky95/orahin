<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:34 PM
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Traits\Authorizable;
use App\Traits\MediaHandling;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class CompanyController extends Controller
{
    use MediaHandling;
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('dashboard.company.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function list()
    {
        return Laratables::recordsOf(Company::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('dashboard.company.create');
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:250|unique:companies,name,NULL,id,deleted_at,NULL',
            'logo' => 'required|file|image',
            'description' => 'required|min:50',
            'website' => 'url'
        ]);
        if ($validator->fails()) {
            if ($request->filled('logo') && $request->logo != null) {
                $this->remove($request->logo);
            }
            return redirect()->back()->withInput($request->input())
                ->withErrors($validator->errors());
        }
        DB::transaction(function () use ($request) {
            $requestData = $request->all();
            $company = Company::create($requestData);
            Log::info('Create Company : ' . $company);
        });
        return redirect()->route('company.index')->with('success', 'Company created');
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return array|string
     * @throws Throwable
     */
    public function show(Company $company)
    {
        return view('dashboard.company.show', compact('company'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return Factory|View
     */
    public function edit(Company $company)
    {
        return view('dashboard.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Company $company
     * @return array|string
     * @throws Throwable
     */
    public function update(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:250|unique:companies,name,' . $company->id . ',id,deleted_at,NULL',
            'description' => 'required|min:50',
            'logo' => 'required|file|image',
            'website' => 'url'
        ]);
        if ($validator->fails()) {
            if ($request->filled('logo') && $request->logo != null) {
                $this->remove($request->logo);
            }
            return redirect()->back()->withInput($request->input())
                ->withErrors($validator->errors());
        }
        DB::transaction(function () use ($request, $company) {
            $requestData = $request->all();
            Log::info('Before update Company : ' . $company);
            $company->update($requestData);
            Log::info('After update Company : ' . $company);
        });
        return redirect()->route('company.index')->with('success', 'Company updated');
    }

    /**
     * Update status the specified resource in storage.
     *
     * @param Request $request
     * @param Company $company
     * @return array|string
     * @throws Throwable
     */
    public function updateStatus(Request $request, Company $company)
    {
        DB::transaction(function () use ($company) {
            $requestData['status'] = 'Active';
            if ($company->status == 'Active') {
                $requestData['status'] = 'Inactive';
            }
            Log::info('Before update Company : ' . $company);
            $company->update($requestData);
            Log::info('After update Company : ' . $company);
        });
        return redirect()->route('company.index')->with('success', 'Company updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return RedirectResponse
     */
    public function destroy(Company $company)
    {
        DB::transaction(function () use ($company) {
            Log::info('Delete Company : ' . $company);
            $company->delete();
        });
        return redirect()->route('company.index')->with('success-sweetalert', 'Company deleted');
    }
}
