<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use DB;
use App\Services\DashboardService;
use Session;
class DashboardController extends Controller
{
    public function __construct(
        DashboardService $dashboardService
    ) {
        $this->dashboardService = $dashboardService;
    }


    public function dashboard(Request $request)
    {
        $dashboardDetail = $this->dashboardService->dashboard();
        // dd($dashboardDetail);

        return view('dashboard', compact('dashboardDetail'));
    }

    public function dataIn(){
        
    }

}
