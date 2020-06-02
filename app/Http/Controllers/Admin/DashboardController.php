<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Permission;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Table;
use App\Models\Tenant;
use App\Models\User;

class DashboardController extends Controller
{
    public function home()
    {
        $tenant = auth()->user()->tenant;
        $totalUsers = User::where('tenant_id', $tenant->id)->count();
        $totalTables = Table::count();
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalTenants = Tenant::count();
        $totalRoles = Role::count();
        $totalProfiles = Profile::count();
        $totalPermissions = Permission::count();
        $totalPlans = Plan::count();
        return view('admin.pages.home.home', compact('totalUsers', 'totalTables', 'totalCategories', 'totalProducts', 'totalTenants', 'totalRoles', 'totalPermissions', 'totalPlans', 'totalProfiles'));
    }
}
