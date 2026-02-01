<?php

namespace App\Http\Controllers;

use App\Models\TrainingType;
use Illuminate\Http\Request;

class TrainingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainingTypes = auth()->user()->gym->trainingTypes()->withCount('plans')->latest()->get();
        return view('training_types.index', compact('trainingTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('training_types.create');
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

        $validated['gym_id'] = auth()->user()->gym_id;

        TrainingType::create($validated);

        return redirect()->route('training-types.index')->with('success', 'تم إضافة نوع التدريب بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingType $trainingType)
    {
        $this->authorizeTrainingType($trainingType);
        $trainingType->load('plans');
        return view('training_types.show', compact('trainingType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingType $trainingType)
    {
        $this->authorizeTrainingType($trainingType);
        return view('training_types.edit', compact('trainingType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrainingType $trainingType)
    {
        $this->authorizeTrainingType($trainingType);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $trainingType->update($validated);

        return redirect()->route('training-types.index')->with('success', 'تم تحديث نوع التدريب بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingType $trainingType)
    {
        $this->authorizeTrainingType($trainingType);
        
        if ($trainingType->plans()->count() > 0) {
            return back()->with('error', 'لا يمكن حذف نوع التدريب لأنه يحتوي على خطط اشتراك مرتبطة به.');
        }

        $trainingType->delete();

        return redirect()->route('training-types.index')->with('success', 'تم حذف نوع التدريب بنجاح.');
    }

    private function authorizeTrainingType(TrainingType $trainingType)
    {
        if ($trainingType->gym_id !== auth()->user()->gym_id) {
            abort(403, 'Unauthorized action.');
        }
    }
}
