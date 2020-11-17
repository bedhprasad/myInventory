<?php

namespace app\Services;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use DB;

Class DashboardService {
    
    function dashboard()
    {
        // dd($id);
        $usersCount = User::count();
        $productCategoryCount = ProductCategory::count();
        $productCount = Product::count();
        $productCategory = ProductCategory::get()->toArray();
        $productCategory1 = [];
        foreach($productCategory as $pcKey=>$pcValue) {
            $pcId = $pcValue['id'];
            $productCategoryCountById = ProductCategory::find($pcId)->products()->count();
            $pcValue['count'] = $productCategoryCountById;
            $productCategoryCountByName[] = $pcValue;
        }
        //to get user login id and name
        $sessionId = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $sessionName = User::find($sessionId)->name;
        // dd($sessionName);

        return [
            'usersCount' => $usersCount,
            'productCategoryCount' => $productCategoryCount,
            'productCount' => $productCount,
            'productCategoryCountById' => $productCategoryCountById,
            'productCategory' => $productCategory,
            'productCategoryCountByName' => $productCategoryCountByName,
            'sessionName' => $sessionName,
        ];
    }
}

?> 