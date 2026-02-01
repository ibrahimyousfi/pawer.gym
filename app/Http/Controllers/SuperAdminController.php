<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\Member;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SuperAdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_gyms' => Gym::count(),
            'active_gyms' => Gym::where('is_active', true)->count(),
            'expired_gyms' => Gym::where('subscription_expires_at', '<', now())->count(),
            'total_members' => Member::count(),
            'total_users' => User::count(),
            'total_subscriptions' => Subscription::count(),
        ];

        $gyms = Gym::withCount(['users', 'members', 'subscriptions'])
            ->latest()
            ->get();

        return view('super_admin.dashboard', compact('gyms', 'stats'));
    }

    public function createGym()
    {
        return view('super_admin.gyms.create');
    }

    public function storeGym(Request $request)
    {
        $request->validate([
            'gym_name' => ['required', 'string', 'max:255'],
            'admin_name' => ['required', 'string', 'max:255'],
            'admin_email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email'],
            'admin_password' => ['required', 'confirmed', Rules\Password::defaults()],
            'subscription_months' => ['required', 'integer', 'min:1', 'max:36'],
        ]);

        // Create Gym
        $gym = Gym::create([
            'name' => $request->gym_name,
            'subscription_expires_at' => now()->addMonths((int)$request->subscription_months),
            'is_active' => true,
        ]);

        // Create Gym Admin
        $user = User::create([
            'name' => $request->admin_name,
            'email' => $request->admin_email,
            'password' => Hash::make($request->admin_password),
            'role' => 'gym_admin',
            'gym_id' => $gym->id,
        ]);

        return redirect()->route('super_admin.dashboard')
            ->with('success', 'تم إنشاء الصالة وحساب المدير بنجاح!');
    }

    public function editGym(Gym $gym)
    {
        return view('super_admin.gyms.edit', compact('gym'));
    }

    public function updateGym(Request $request, Gym $gym)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'subscription_expires_at' => ['required', 'date'],
            'is_active' => ['required', 'boolean'],
        ]);

        $gym->update($request->all());

        return redirect()->route('super_admin.dashboard')
            ->with('success', 'تم تحديث بيانات الصالة بنجاح!');
    }

    public function toggleGymStatus(Gym $gym)
    {
        $gym->update(['is_active' => !$gym->is_active]);

        return redirect()->route('super_admin.dashboard')
            ->with('success', 'تم تغيير حالة الصالة بنجاح!');
    }

    public function extendSubscription(Request $request, Gym $gym)
    {
        $request->validate([
            'months' => ['required', 'integer', 'min:1', 'max:12'],
        ]);

        $months = (int)$request->months;

        $newExpiryDate = $gym->subscription_expires_at > now()
            ? $gym->subscription_expires_at->copy()->addMonths($months)
            : now()->addMonths($months);

        $gym->update(['subscription_expires_at' => $newExpiryDate]);

        return redirect()->route('super_admin.dashboard')
            ->with('success', 'تم تمديد الاشتراك بنجاح!');
    }

    public function destroyGym(Gym $gym)
    {
        // Delete all related data
        $gym->members()->delete();
        $gym->users()->delete();
        $gym->trainingTypes()->delete();
        $gym->plans()->delete();
        $gym->products()->delete();
        $gym->orders()->delete();
        $gym->subscriptions()->delete();
        $gym->delete();

        return redirect()->route('super_admin.dashboard')
            ->with('success', 'تم حذف الصالة وجميع بياناتها بنجاح!');
    }

    public function showGymDetails(Gym $gym)
    {
        $gym->load(['users', 'members', 'subscriptions.member', 'subscriptions.plan']);

        return view('super_admin.gyms.show', compact('gym'));
    }

    public function indexGyms()
    {
        $gyms = Gym::withCount(['users', 'members', 'subscriptions'])
            ->latest()
            ->paginate(10);

        return view('super_admin.gyms.index', compact('gyms'));
    }

    public function indexUsers()
    {
        $users = User::with('gym')
            ->latest()
            ->paginate(20);

        return view('super_admin.users.index', compact('users'));
    }

    public function indexReports()
    {
        return view('super_admin.reports.index');
    }
}
