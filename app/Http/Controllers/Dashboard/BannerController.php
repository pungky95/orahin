<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.com
 * @date 12/18/19, 11:16 PM
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Rules\BannerActiveDate;
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

class BannerController extends Controller
{

    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('dashboard.banner.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function list()
    {
        return Laratables::recordsOf(Banner::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('dashboard.banner.create');
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
            'name' => 'required|max:250',
            'image' => 'required',
            'active_date' => ['required', new BannerActiveDate($request->active_date)],
            'description' => 'required',
            'link' => 'url|nullable',
        ]);
        DB::transaction(function () use ($request) {
            $requestData = $request->all();
            $date = explode(' / ', $request->active_date);
            $requestData['start_date'] = Carbon::parse($date[0])->format('Y-m-d');
            $requestData['end_date'] = Carbon::parse($date[1])->format('Y-m-d');
            $banner = Banner::create($requestData);
            Log::info('Create Banner : ' . $banner);
        });
        return redirect()->route('banner.index')->with('success', 'Banner created');
    }

    /**
     * Display the specified resource.
     *
     * @param Banner $banner
     * @return array|string
     * @throws Throwable
     */
    public function show(Banner $banner)
    {
        return view('dashboard.banner.show', compact('banner'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Banner $banner
     * @return Factory|View
     */
    public function edit(Banner $banner)
    {
        return view('dashboard.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Banner $banner
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Banner $banner)
    {
        $this->validate($request, [
            'name' => 'required|max:250',
            'active_date' => ['required', new BannerActiveDate($request->active_date)],
            'description' => 'required',
            'link' => 'url|nullable',
        ]);
        DB::transaction(function () use ($banner, $request) {
            $requestData = $request->all();
            $date = explode(' / ', $request->active_date);
            $requestData['start_date'] = Carbon::parse($date[0])->format('Y-m-d');
            $requestData['end_date'] = Carbon::parse($date[1])->format('Y-m-d');
            Log::info('Before update : ' . $banner);
            $banner->update($requestData);
            Log::info('After update : ' . $banner);
        });
        return redirect()->route('banner.index')->with('success', 'Banner updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Banner $banner
     * @return RedirectResponse
     */
    public function destroy(Banner $banner)
    {
        DB::transaction(function () use ($banner) {
            Log::info('Delete Banner : ' . $banner);
            $banner->delete();
        });
        return redirect()->route('banner.index')->with('success-sweetalert', 'Banner deleted');
    }
}
