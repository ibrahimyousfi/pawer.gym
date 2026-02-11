<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Member Statistics
        $totalMembers = \App\Models\Member::count();
        $activeMembers = \App\Models\Member::active()->count();
        $expiredMembers = \App\Models\Member::expired()->count();
        $inactiveMembers = \App\Models\Member::inactive()->count();
        
        // Expiring Soon (within 7 days)
        $expiringSoon = \App\Models\Subscription::whereBetween('end_date', [
            now()->toDateString(),
            now()->addDays(7)->toDateString()
        ])->distinct('member_id')->count('member_id');

        // Revenue Statistics
        $subscriptionRevenue = \App\Models\Subscription::sum('price_snapshot');
        $totalRevenue = $subscriptionRevenue;

        // Recent Activities
        $recentMembers = \App\Models\Member::with('subscriptions.plan')
            ->latest()
            ->take(5)
            ->get();

        // Prepare filters for header
        $filters = [
            [
                'label' => 'All Members',
                'url' => route('dashboard'),
                'active' => true,
                'count' => $totalMembers
            ],
            [
                'label' => 'Active',
                'url' => route('members.index', ['status' => 'active']),
                'active' => false,
                'count' => $activeMembers
            ],
            [
                'label' => 'Expired',
                'url' => route('members.index', ['status' => 'expired']),
                'active' => false,
                'count' => $expiredMembers
            ],
            [
                'label' => 'Expiring Soon',
                'url' => route('members.index'),
                'active' => false,
                'count' => $expiringSoon
            ]
        ];

        return view('dashboard', compact(
            'totalMembers',
            'activeMembers',
            'expiredMembers',
            'inactiveMembers',
            'expiringSoon',
            'subscriptionRevenue',
            'totalRevenue',
            'recentMembers',
            'filters'
        ))
            ->with('pageTitle', 'Dashboard')
            ->with('pageSearchRoute', route('members.index'))
            ->with('pageSearchPlaceholder', 'Search members...')
            ->with('pageShowSearch', true);
    }
}
