<?php

namespace App\Http\Controllers;

use App\Models\TrainingType;
use Illuminate\Http\Request;

class TrainingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TrainingType::withCount('plans');

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $trainingTypes = $query->latest()->get();
        
        // Prepare filters
        $filters = [
            [
                'label' => 'All Types',
                'url' => route('training-types.index'),
                'active' => !request('search'),
                'count' => $trainingTypes->count()
            ]
        ];

        return view('abn.training_types.index', compact('trainingTypes', 'filters'))
            ->with('pageTitle', 'Subscription Types')
            ->with('pageActionUrl', route('training-types.create'))
            ->with('pageActionLabel', 'Add New Type')
            ->with('pageShowAction', true)
            ->with('pageSearchRoute', route('training-types.index'))
            ->with('pageSearchPlaceholder', 'Search by name or description...')
            ->with('pageShowSearch', true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('abn.training_types.create')
            ->with('pageTitle', 'Create Subscription Type')
            ->with('pageActionUrl', route('training-types.index'))
            ->with('pageActionLabel', 'Back to Types')
            ->with('pageShowAction', true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        TrainingType::create($validated);

        return redirect()->route('training-types.index')->with('success', 'Training type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingType $trainingType)
    {
        $trainingType->load('plans');
        return view('abn.training_types.show', compact('trainingType'))
            ->with('pageTitle', $trainingType->name)
            ->with('pageSubtitle', 'Subscription Type Details')
            ->with('pageActionUrl', route('plans.create', ['training_type_id' => $trainingType->id]))
            ->with('pageActionLabel', 'Add New Plan')
            ->with('pageShowAction', true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingType $trainingType)
    {
        return view('abn.training_types.edit', compact('trainingType'))
            ->with('pageTitle', 'Edit Subscription Type')
            ->with('pageSubtitle', $trainingType->name)
            ->with('pageActionUrl', route('training-types.show', $trainingType))
            ->with('pageActionLabel', 'View Details')
            ->with('pageShowAction', true);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrainingType $trainingType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $trainingType->update($validated);

        return redirect()->route('training-types.index')->with('success', 'Training type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingType $trainingType)
    {
        if ($trainingType->plans()->count() > 0) {
            return back()->with('error', 'Cannot delete training type because it has associated subscription plans.');
        }

        $trainingType->delete();

        return redirect()->route('training-types.index')->with('success', 'Training type deleted successfully.');
    }
}
