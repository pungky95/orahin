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
use App\Models\City;
use App\Models\Company;
use App\Models\Customer;
use App\Models\District;
use App\Models\Province;
use App\Models\Role;
use App\Models\Village;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Select2Controller extends Controller
{
    /**
     *  Display a listing of resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function select2Role(Request $request)
    {
        $page = $request->page;
        $resultCount = 10;

        $offset = ($page - 1) * $resultCount;

        $roles = Role::query();
        $roles->where('id', '!=', 1);
        if ($request->filled('search')) {
            $roles->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('selected_role')) {
            $roles->where('id', $request->selected_role);
            $roles = $roles->first(['id', DB::raw('name as text')]);
            return response()->json($roles);
        }
        $count = $roles->count();
        $roles->skip($offset)->limit($resultCount);
        $roles->orderBy('name', 'asc');
        $roles = $roles->get(['id', DB::raw('name as text')]);

        $endCount = $offset + $resultCount;
        $morePages = $count > $endCount;

        $result = array(
            'results' => $roles,
            'pagination' => array(
                'more' => $morePages,
            ),
        );
        return response()->json($result);
    }

    /**
     *  Display a listing of resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function select2Category(Request $request)
    {
        $page = $request->page;
        $resultCount = 10;

        $offset = ($page - 1) * $resultCount;

        $category = Category::query();
        if ($request->filled('search')) {
            $category->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('selected_category')) {
            $category->where('id', $request->selected_category);
            $category = $category->first(['id', DB::raw('name as text')]);
            return response()->json($category);
        }
        $count = $category->count();
        $category->skip($offset)->limit($resultCount);
        $category->orderBy('name', 'asc');
        $category = $category->get(['id', DB::raw('name as text')]);

        $endCount = $offset + $resultCount;
        $morePages = $count > $endCount;

        $result = array(
            'results' => $category,
            'pagination' => array(
                'more' => $morePages,
            ),
        );
        return response()->json($result);
    }

    /**
     *  Display a listing of resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function select2Company(Request $request)
    {
        $page = $request->page;
        $resultCount = 10;

        $offset = ($page - 1) * $resultCount;

        $companies = Company::query();
        if ($request->filled('search')) {
            $companies->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('selected_company')) {
            $companies->where('id', $request->selected_company);
            $companies = $companies->first(['id', DB::raw('name as text')]);
            return response()->json($companies);
        }
        $count = $companies->count();
        $companies->skip($offset)->limit($resultCount);
        $companies->orderBy('name', 'asc');
        $companies = $companies->get(['id', DB::raw('name as text')]);

        $endCount = $offset + $resultCount;
        $morePages = $count > $endCount;

        $result = array(
            'results' => $companies,
            'pagination' => array(
                'more' => $morePages,
            ),
        );
        return response()->json($result);
    }

    /**
     *  Display a listing of resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function select2Province(Request $request)
    {
        $page = $request->page;
        $resultCount = 10;

        $offset = ($page - 1) * $resultCount;

        $provinces = Province::query();
        if ($request->filled('search')) {
            $provinces->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('selected_province')) {
            $provinces->where('id', $request->selected_province);
            $provinces = $provinces->first(['id', DB::raw('name as text')]);
            return response()->json($provinces);
        }
        $count = $provinces->count();
        $provinces->skip($offset)->limit($resultCount);
        $provinces->orderBy('name', 'asc');
        $provinces = $provinces->get(['id', DB::raw('name as text')]);

        $endCount = $offset + $resultCount;
        $morePages = $count > $endCount;

        $result = array(
            'results' => $provinces,
            'pagination' => array(
                'more' => $morePages,
            ),
        );
        return response()->json($result);
    }

    /**
     *  Display a listing of resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function select2City(Request $request)
    {
        $page = $request->page;
        $resultCount = 10;

        $offset = ($page - 1) * $resultCount;

        $cities = City::query();
        if ($request->filled('search')) {
            $cities->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('province_id')) {
            $cities->where('province_id', $request->province_id);
        }
        if ($request->filled('selected_city')) {
            $cities->where('id', $request->selected_city);
            $cities = $cities->first(['id', DB::raw('name as text')]);
            return response()->json($cities);
        }
        $count = $cities->count();
        $cities->skip($offset)->limit($resultCount);
        $cities->orderBy('name', 'asc');
        $cities = $cities->get(['id', DB::raw('name as text')]);

        $endCount = $offset + $resultCount;
        $morePages = $count > $endCount;

        $result = array(
            'results' => $cities,
            'pagination' => array(
                'more' => $morePages,
            ),
        );
        return response()->json($result);
    }

    /**
     *  Display a listing of resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function select2District(Request $request)
    {
        $page = $request->page;
        $resultCount = 10;

        $offset = ($page - 1) * $resultCount;

        $disricts = District::query();
        if ($request->filled('search')) {
            $disricts->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('city_id')) {
            $disricts->where('city_id', $request->city_id);
        }
        if ($request->filled('selected_district')) {
            $disricts->where('id', $request->selected_district);
            $disricts = $disricts->first(['id', DB::raw('name as text')]);
            return response()->json($disricts);
        }
        $count = $disricts->count();
        $disricts->skip($offset)->limit($resultCount);
        $disricts->orderBy('name', 'asc');
        $disricts = $disricts->get(['id', DB::raw('name as text')]);

        $endCount = $offset + $resultCount;
        $morePages = $count > $endCount;

        $result = array(
            'results' => $disricts,
            'pagination' => array(
                'more' => $morePages,
            ),
        );
        return response()->json($result);
    }

    /**
     *  Display a listing of resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function select2Village(Request $request)
    {
        $page = $request->page;
        $resultCount = 10;

        $offset = ($page - 1) * $resultCount;

        $villages = Village::query();
        if ($request->filled('search')) {
            $villages->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('district_id')) {
            $villages->where('district_id', $request->district_id);
        }
        if ($request->filled('selected_village')) {
            $villages->where('id', $request->selected_village);
            $villages = $villages->first(['id', DB::raw('name as text')]);
            return response()->json($villages);
        }
        $count = $villages->count();
        $villages->skip($offset)->limit($resultCount);
        $villages->orderBy('name', 'asc');
        $villages = $villages->get(['id', DB::raw('name as text')]);

        $endCount = $offset + $resultCount;
        $morePages = $count > $endCount;

        $result = array(
            'results' => $villages,
            'pagination' => array(
                'more' => $morePages,
            ),
        );
        return response()->json($result);
    }

    /**
     *  Display a listing of resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function select2Customer(Request $request)
    {
        $page = $request->page;
        $resultCount = 10;

        $offset = ($page - 1) * $resultCount;

        $customers = Customer::query();
        if ($request->filled('search')) {
            $customers->orWhere(DB::raw('name'), 'like', '%' . $request->search . '%');
        }
        if ($request->filled('selected_customer')) {
            $customers->where('uid', $request->selected_customer);
            $customers = $customers->first(['uid as id', DB::raw('name as text')]);
            return response()->json($customers);
        }
        $count = $customers->count();
        $customers->skip($offset)->limit($resultCount);
        $customers->orderBy('name', 'asc');
        $customers = $customers->get(['uid as id', DB::raw('name as text')]);

        $endCount = $offset + $resultCount;
        $morePages = $count > $endCount;

        $result = array(
            'results' => $customers,
            'pagination' => array(
                'more' => $morePages,
            ),
        );
        return response()->json($result);
    }
}
