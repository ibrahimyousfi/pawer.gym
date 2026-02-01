<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Redirect Super Admin to their dedicated dashboard
        if ($user->isSuperAdmin()) {
            return redirect()->route('super_admin.dashboard');
        }

        $gym = $user->gym;

        if (!$gym) {
            abort(403, 'Unauthorized action.');
        }

        // Member Statistics (scoped to gym)
        $totalMembers = $gym->members()->count();
        $activeMembers = $gym->members()->active()->count();
        $expiredMembers = $gym->members()->expired()->count();
        $inactiveMembers = $gym->members()->inactive()->count();
        
        // Expiring Soon (within 7 days) (scoped to gym)
        $expiringSoon = $gym->subscriptions()
            ->whereBetween('end_date', [
                now()->toDateString(),
                now()->addDays(7)->toDateString()
            ])->distinct('member_id')->count('member_id');

        // Revenue Statistics (scoped to gym)
        $subscriptionRevenue = $gym->subscriptions()->sum('price_snapshot');
        $productRevenue = $gym->orders()->sum('total_amount');
        $totalRevenue = $subscriptionRevenue + $productRevenue;

        // Recent Activities (scoped to gym)
        $recentMembers = $gym->members()->with('subscriptions.plan')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalMembers',
            'activeMembers',
            'expiredMembers',
            'inactiveMembers',
            'expiringSoon',
            'subscriptionRevenue',
            'productRevenue',
            'totalRevenue',
            'recentMembers'
        ));
    }
}
