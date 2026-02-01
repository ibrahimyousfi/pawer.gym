<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\TrainingType;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    private function getGym()
    {
        return auth()->user()->gym;
    }

    public function index(Request $request)
    {
        $gym = $this->getGym();
        $query = $gym->members()->with(['subscriptions.plan.trainingType']);

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
        $trainingTypes = $gym->trainingTypes;

        // Calculate counts
        $counts = [
            'status' => [
                'all' => $gym->members()->count(),
                'active' => $gym->members()->active()->count(),
                'expired' => $gym->members()->expired()->count(),
                'inactive' => $gym->members()->inactive()->count(),
            ],
            'training_type' => [
                'all' => $gym->members()->count(),
            ]
        ];

        foreach ($trainingTypes as $type) {
            $counts['training_type'][$type->id] = $gym->members()->whereHas('subscriptions.plan', function($q) use ($type) {
                $q->where('training_type_id', $type->id);
            })->count();
        }
        
        return view('members.index', compact('members', 'trainingTypes', 'counts'));
    }

    public function create(Request $request)
    {
        $gym = $this->getGym();
        // Get all active plans sorted by training type for this gym
        $trainingTypes = $gym->trainingTypes()->with(['plans' => function($query) {
            $query->active();
        }])->get();

        return view('members.create', [
            'trainingTypes' => $trainingTypes,
            'preselectedTrainingTypeId' => $request->training_type_id,
            'preselectedPlanId' => $request->plan_id
        ]);
    }

    public function store(\App\Http\Requests\StoreMemberRequest $request)
    {
        $gym = $this->getGym();

        // Start Transaction
        DB::transaction(function () use ($request, $gym) {
            
            // 1. Create Member
            $data = $request->validated();
            $data['gym_id'] = $gym->id; // Assign to current gym

            if ($request->hasFile('photo')) {
                $data['photo_path'] = $request->file('photo')->store('members', 'uploads');
            }
            
            $member = Member::create($data);

            // 2. Create Subscription
            // Ensure plan belongs to this gym
            $plan = $gym->plans()->findOrFail($request->plan_id);
            
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
                'gym_id' => $gym->id, // Add gym_id to subscription
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
        $this->authorizeMember($member);
        $member->load('subscriptions.plan.trainingType');
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        $this->authorizeMember($member);
        $gym = $this->getGym();
        
        $trainingTypes = $gym->trainingTypes()->with(['plans' => function($query) {
            $query->active();
        }])->get();

        return view('members.edit', compact('member', 'trainingTypes'));
    }

    public function update(Request $request, Member $member)
    {
        $this->authorizeMember($member);
        
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
        $this->authorizeMember($member);
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }

    public function renew(Member $member)
    {
        $this->authorizeMember($member);
        $gym = $this->getGym();
        
        $trainingTypes = $gym->trainingTypes()->with(['plans' => function($query) {
            $query->active();
        }])->get();

        return view('members.renew', compact('member', 'trainingTypes'));
    }

    public function storeRenewal(Request $request, Member $member)
    {
        $this->authorizeMember($member);
        $gym = $this->getGym();

        $validated = $request->validate([
            'plan_id' => ['required', 'exists:plans,id'],
            'start_date' => ['required', 'date'],
        ]);

        // Ensure plan belongs to gym
        $plan = $gym->plans()->findOrFail($validated['plan_id']);
        
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
            'gym_id' => $gym->id, // Add gym_id
            'plan_id' => $plan->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'price_snapshot' => $plan->price,
        ]);

        return redirect()->route('members.index')->with('success', 'Subscription renewed successfully.');
    }

    private function authorizeMember(Member $member)
    {
        if ($member->gym_id !== auth()->user()->gym_id) {
            abort(403, 'Unauthorized action.');
        }
    }
}
