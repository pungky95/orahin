<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:34 PM
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bulletin;
use App\Rules\BulletinActiveDate;
use App\Traits\Authorizable;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;


class BulletinController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('dashboard.bulletin.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function list()
    {
        return Laratables::recordsOf(Bulletin::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('dashboard.bulletin.create');
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
            'company_id' => 'required|exists:companies,id',
            'job_name' => 'required|max:250',
            'description' => 'required|min:50',
            'salary' => 'required|max:150',
            'time_period' => 'required|in:Day,Week,Month,Year',
            'active_date' => ['required', new BulletinActiveDate($request->active_date)]
        ]);
        DB::transaction(function () use ($request) {
            $requestData = $request->all();
            $date = explode(' / ', $request->active_date);
            $requestData['start_date'] = Carbon::parse($date[0])->format('Y-m-d');
            $requestData['end_date'] = Carbon::parse($date[1])->format('Y-m-d');
            $bulletin = Bulletin::create($requestData);
            Log::info('Create Bulletin : ' . $bulletin);
        });
        return redirect()->route('bulletin.index')->with('success', 'Bulletin created');
    }

    /**
     * Display the specified resource.
     *
     * @param Bulletin $bulletin
     * @return array|string
     * @throws Throwable
     */
    public function show(Bulletin $bulletin)
    {
        return view('dashboard.bulletin.show', compact('bulletin'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Bulletin $bulletin
     * @return Factory|View
     */
    public function edit(Bulletin $bulletin)
    {
        return view('dashboard.bulletin.edit', compact('bulletin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Bulletin $bulletin
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Bulletin $bulletin)
    {
        $this->validate($request, [
            'company_id' => 'required|exists:companies,id',
            'job_name' => 'required|max:250',
            'description' => 'required|min:50',
            'salary' => 'required|max:150',
            'time_period' => 'required|in:Day,Week,Month,Year',
            'active_date' => ['required', new BulletinActiveDate($request->active_date)]
        ]);
        DB::transaction(function () use ($request, $bulletin) {
            $requestData = $request->all();
            $date = explode(' / ', $request->active_date);
            $requestData['start_date'] = Carbon::parse($date[0])->format('Y-m-d');
            $requestData['end_date'] = Carbon::parse($date[1])->format('Y-m-d');
            Log::info('Before update Bulletin : ' . $bulletin);
            $bulletin->update($requestData);
            Log::info('After update Bulletin : ' . $bulletin);
        });

        return redirect()->route('bulletin.index')->with('success', 'Bulletin updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bulletin $bulletin
     * @return RedirectResponse
     */
    public function destroy(Bulletin $bulletin)
    {
        DB::transaction(function () use ($bulletin) {
            Log::info('Delete Bulletin : ' . $bulletin);
            $bulletin->delete();
        });
        return redirect()->route('bulletin.index')->with('success-sweetalert', 'Bulletin deleted');
    }
}
