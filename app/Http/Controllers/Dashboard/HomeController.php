<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:34 PM
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display reports
     * @return Factory|View
     */
    public function home()
    {
        $currentYear = Carbon::now()->format('Y');
        $customers = Customer::selectRaw('MONTH (updated_at) AS month, COUNT(*) as subtotal')
            ->whereYear('updated_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
        return view('dashboard.home.home', compact('customers'));
    }
}
