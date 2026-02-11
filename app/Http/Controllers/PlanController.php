<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\TrainingType;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $trainingTypes = TrainingType::all();
        $selectedTrainingTypeId = $request->training_type_id;

        return view('abn.plans.create', compact('trainingTypes', 'selectedTrainingTypeId'))
            ->with('pageTitle', 'Create Subscription Plan')
            ->with('pageActionUrl', $selectedTrainingTypeId ? route('training-types.show', $selectedTrainingTypeId) : route('training-types.index'))
            ->with('pageActionLabel', 'Back')
            ->with('pageShowAction', true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'training_type_id' => 'required|exists:training_types,id',
            'name' => 'required|string|max:255',
            'duration_days' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $trainingType = TrainingType::findOrFail($validated['training_type_id']);

        Plan::create([
            'training_type_id' => $trainingType->id,
            'name' => $validated['name'],
            'duration_days' => $validated['duration_days'],
            'price' => $validated['price'],
            'is_active' => true,
        ]);

        return redirect()->route('training-types.show', $trainingType)->with('success', 'Subscription plan created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        return view('abn.plans.edit', compact('plan'))
            ->with('pageTitle', 'Edit Subscription Plan')
            ->with('pageSubtitle', $plan->name)
            ->with('pageActionUrl', route('training-types.show', $plan->training_type_id))
            ->with('pageActionLabel', 'Back to Type')
            ->with('pageShowAction', true);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'duration_days' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $plan->update($validated);

        return redirect()->route('training-types.show', $plan->training_type_id)->with('success', 'Subscription plan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $trainingTypeId = $plan->training_type_id;
        $plan->delete();

        return redirect()->route('training-types.show', $trainingTypeId)->with('success', 'Subscription plan deleted successfully.');
    }
}
