<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\TrainingType;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::with(['subscriptions.plan.trainingType']);

        // Filter by Training Type
        if ($request->filled('training_type_id')) {
            $query->whereHas('subscriptions.plan', function($q) use ($request) {
                $q->where('training_type_id', $request->training_type_id);
            });
        }

        if ($request->has('status')) {
            switch ($request->status) {
                case 'active':
                    $query->active();
                    break;
                case 'expired':
                    $query->expired();
                    break;
                case 'inactive':
                    $query->inactive();
                    break;
            }
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('cin', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $members = $query->latest()->paginate(10);
        $trainingTypes = TrainingType::all();

        // Calculate counts
        $counts = [
            'status' => [
                'all' => Member::count(),
                'active' => Member::active()->count(),
                'expired' => Member::expired()->count(),
                'inactive' => Member::inactive()->count(),
            ],
            'training_type' => [
                'all' => Member::count(),
            ]
        ];

        foreach ($trainingTypes as $type) {
            $counts['training_type'][$type->id] = Member::whereHas('subscriptions.plan', function($q) use ($type) {
                $q->where('training_type_id', $type->id);
            })->count();
        }

        // Prepare filters for header
        $filters = [];
        
        // Status filters
        $filters[] = [
            'label' => 'All',
            'url' => request()->fullUrlWithQuery(['status' => '', 'training_type_id' => '']),
            'active' => !request('status') && !request('training_type_id'),
            'count' => $counts['status']['all']
        ];
        $filters[] = [
            'label' => 'Active',
            'url' => request()->fullUrlWithQuery(['status' => 'active']),
            'active' => request('status') == 'active',
            'count' => $counts['status']['active']
        ];
        $filters[] = [
            'label' => 'Expired',
            'url' => request()->fullUrlWithQuery(['status' => 'expired']),
            'active' => request('status') == 'expired',
            'count' => $counts['status']['expired']
        ];
        $filters[] = [
            'label' => 'Inactive',
            'url' => request()->fullUrlWithQuery(['status' => 'inactive']),
            'active' => request('status') == 'inactive',
            'count' => $counts['status']['inactive']
        ];
        
        // Training type filters
        foreach ($trainingTypes as $type) {
            $filters[] = [
                'label' => $type->name,
                'url' => request()->fullUrlWithQuery(['training_type_id' => $type->id]),
                'active' => request('training_type_id') == $type->id,
                'count' => $counts['training_type'][$type->id] ?? 0
            ];
        }
        
        return view('members.index', compact('members', 'trainingTypes', 'counts', 'filters'))
            ->with('pageTitle', 'Members Management')
            ->with('pageActionUrl', route('members.create', ['training_type_id' => request('training_type_id')]))
            ->with('pageActionLabel', 'Add Member')
            ->with('pageShowAction', true)
            ->with('pageSearchRoute', route('members.index'))
            ->with('pageSearchPlaceholder', 'Search by name, CIN, or phone...')
            ->with('pageShowSearch', true);
    }

    public function create(Request $request)
    {
        // Get all active plans sorted by training type
        $trainingTypes = TrainingType::with(['plans' => function($query) {
            $query->active();
        }])->get();

        return view('members.create', [
            'trainingTypes' => $trainingTypes,
            'preselectedTrainingTypeId' => $request->training_type_id,
            'preselectedPlanId' => $request->plan_id
        ])
            ->with('pageTitle', 'Add New Member')
            ->with('pageActionUrl', route('members.index'))
            ->with('pageActionLabel', 'Back to Members')
            ->with('pageShowAction', true);
    }

    public function store(\App\Http\Requests\StoreMemberRequest $request)
    {
        // Start Transaction
        DB::transaction(function () use ($request) {
            
            // 1. Create Member
            $data = $request->validated();

            if ($request->hasFile('photo')) {
                $data['photo_path'] = $request->file('photo')->store('members', 'uploads');
            }
            
            $member = Member::create($data);

            // 2. Create Subscription
            $plan = Plan::findOrFail($request->plan_id);
            
            $startDate = \Carbon\Carbon::parse($request->start_date);
            
            // Calculate end date logically
            $endDate = match((int)$plan->duration_days) {
                30 => $startDate->copy()->addMonth(),
                90 => $startDate->copy()->addMonths(3),
                180 => $startDate->copy()->addMonths(6),
                365 => $startDate->copy()->addYear(),
                default => $startDate->copy()->addDays($plan->duration_days),
            };

            $member->subscriptions()->create([
                'plan_id' => $plan->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'price_snapshot' => $plan->price,
            ]);
        });

        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    public function show(Member $member)
    {
        $member->load('subscriptions.plan.trainingType');
        return view('members.show', compact('member'))
            ->with('pageTitle', 'Member Details')
            ->with('pageSubtitle', $member->full_name)
            ->with('pageActionUrl', route('members.index'))
            ->with('pageActionLabel', 'Back to Members')
            ->with('pageShowAction', true);
    }

    public function edit(Member $member)
    {
        $trainingTypes = TrainingType::with(['plans' => function($query) {
            $query->active();
        }])->get();

        return view('members.edit', compact('member', 'trainingTypes'))
            ->with('pageTitle', 'Edit Member')
            ->with('pageSubtitle', $member->full_name)
            ->with('pageActionUrl', route('members.show', $member))
            ->with('pageActionLabel', 'View Details')
            ->with('pageShowAction', true);
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'cin' => ['required', 'string', 'max:20', 'unique:members,cin,' . $member->id],
            'gender' => ['required', 'in:male,female'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')->store('members', 'uploads');
        }

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }

    public function renew(Member $member)
    {
        $trainingTypes = TrainingType::with(['plans' => function($query) {
            $query->active();
        }])->get();

        return view('members.renew', compact('member', 'trainingTypes'))
            ->with('pageTitle', 'Renew Subscription')
            ->with('pageSubtitle', $member->full_name)
            ->with('pageActionUrl', route('members.show', $member))
            ->with('pageActionLabel', 'Back to Member')
            ->with('pageShowAction', true);
    }

    public function storeRenewal(Request $request, Member $member)
    {
        $validated = $request->validate([
            'plan_id' => ['required', 'exists:plans,id'],
            'start_date' => ['required', 'date'],
        ]);

        $plan = Plan::findOrFail($validated['plan_id']);
        
        $startDate = \Carbon\Carbon::parse($validated['start_date']);
        
        // Calculate end date logically
        $endDate = match((int)$plan->duration_days) {
            30 => $startDate->copy()->addMonth(),
            90 => $startDate->copy()->addMonths(3),
            180 => $startDate->copy()->addMonths(6),
            365 => $startDate->copy()->addYear(),
            default => $startDate->copy()->addDays($plan->duration_days),
        };

        $member->subscriptions()->create([
            'plan_id' => $plan->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'price_snapshot' => $plan->price,
        ]);

        return redirect()->route('members.index')->with('success', 'Subscription renewed successfully.');
    }
}
