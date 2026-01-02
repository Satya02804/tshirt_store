<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class dashboardController extends Controller
{

    public function __construct()
    {
        // Apply middleware to specific methods
        $this->middleware('permission:view-dashboard')->only(['dashboard', 'Tshirts']);
        $this->middleware('permission:view-analytics')->only(['Tshirts']);
        $this->middleware('permission:view-users')->only(['users']);
        $this->middleware('permission:delete-users')->only(['deleteUser']);
        $this->middleware('role:super-admin')->only(['assignRole', 'updatePermissions']);
        $this->middleware('permission:view-orders')->only(['orders']);
        $this->middleware('permission:view-earnings')->only(['earnings']);
    }

    public function dashboard()
    {
        $products = Product::all();
        return view('dashboard.dashboard', compact('products'));
    }

    //dashboard card
    public function Tshirts()
    {
        $totalTshirt = Product::count();
        $totalInventorySum = Product::sum('price');
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalEarnings = Order::sum('total_price');

        // Get current permissions for each role
        $adminRole = Role::findByName('admin');
        $userRole = Role::findByName('user');

        $adminPermissions = $adminRole->permissions->pluck('name')->toArray();
        $userPermissions = $userRole->permissions->pluck('name')->toArray();

        return view('dashboard.dashboardHome', compact(
            'totalTshirt',
            'totalInventorySum',
            'totalUsers',
            'totalOrders',
            'totalEarnings',
            'adminPermissions',
            'userPermissions'
        ));
    }

    public function users()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();

        return view('dashboard.users', compact('users', 'roles'));
    }
    //orders page
    public function orders()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->get();
        return view('dashboard.orders', compact('orders'));
    }


    public function allOrders()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->get();
        return view('dashboard.orders', compact('orders'));
    }



    public function earnings()
    {
        $orders = Order::with('user')
            ->where('status', '!=', 'cancelled')
            ->latest()
            ->get();

        return view('dashboard.earnings', compact('orders'));
    }

    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role'    => 'required|exists:roles,name'
        ]);

        $user = User::find($request->user_id);

        if (!$user) {
            return back()->with('error', 'User not found!');
        }

        // Prevent changing super-admin role
        if ($user->hasRole('super-admin')) {
            return back()->with('error', 'Cannot change Super Admin role!');
        }

        // Prevent assigning super-admin role
        if ($request->role === 'super-admin') {
            return back()->with('error', 'Cannot assign Super Admin role!');
        }

        // Prevent users from changing their own role
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot change your own role!');
        }

        // 1. Spatie Logic: Remove old roles and assign new one
        $user->roles()->detach();
        $user->assignRole($request->role);

        $user->role = $request->role;
        $user->save();

        // Clear permission cache for this user
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        return back()->with('success', "Role changed to '" . ucfirst($request->role) . "' for {$user->name}!");
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        //  deleting super-admin
        if ($user->hasRole('super-admin')) {
            return redirect()->back()->with('error', 'Cannot delete the Super Admin!');
        }

        //  self-deletion
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot delete your own account!');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->back()->with('success', "User '{$userName}' deleted successfully!");
    }

    public function updatePermissions(Request $request)
    {
        $permissions = $request->input('permissions', []);

        // Update Admin Role
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminRole->syncPermissions($permissions['admin'] ?? []);
        }

        // Update User Role
        $userRole = Role::where('name', 'user')->first();
        if ($userRole) {
            $userRole->syncPermissions($permissions['user'] ?? []);
        }

        // Clear ALL permission caches
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Also clear Laravel cache
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');

        return back()->with('success', 'Role permissions updated successfully!');
    }
}
