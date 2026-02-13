<?php

namespace Modules\CourseAdministration\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\CourseAdministration\Http\Requests\CreateTrainingBatchesRequest;
use Modules\CourseAdministration\Http\Requests\UpdateTrainingBatchesRequest;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\CourseAdministration\Models\TrainingScheduleItem;

class TrainingBatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Return the view for listing training batches
        return view('courseadministration.training_batches.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch related training courses for display
        $trainingCourses = TrainingCourse::all();
        // Fetch related training schedule items for display
        $trainigScheduleItems = TrainingScheduleItem::all();
        // Fetch trainers for selection
        $trainers = User::role(['Trainer'])
            ->orderBy('name', 'asc')
            ->get();

        return view('courseadministration.training_batches.create', compact('trainingCourses', 'trainers', 'trainigScheduleItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTrainingBatchesRequest $request)
    {
        // Handle the creation of a new training batch
        $validatedData = $request->validated();
        // Create the training batch
        TrainingBatch::create($validatedData);
        // Redirect to the training batches index with a success message
        return redirect()
            ->route('training_batches.index')
            ->with('success', 'Training Batch created successfully.');
    }

    /** 
     * Show the specified resource.
     */
    public function show($uuid)
    {
        // dd('show function called in TrainingBatchController');
        // Display the specified training batch
        $trainingBatch = TrainingBatch::where('uuid', $uuid)->firstOrFail();
        // Fetch related training courses for display
        $trainingCourses = TrainingCourse::all();
        // Fetch trainers for selection
        $trainers = User::orderBy('name', 'asc')->get();
        // Return the view with the training batch data
        return view('courseadministration.training_batches.view', compact('trainingBatch', 'trainingCourses', 'trainers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit($id)
    // {
    //     return view('courseadministration::edit');
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingBatchesRequest $request, $uuid)
    {
        // dd('update function called in TrainingBatchController', $request->validated());
        // Handle the update of an existing training batch
        $trainingBatch = TrainingBatch::where('uuid', $uuid)->firstOrFail();
        // Update the training batch with validated data
        $validatedData = $request->validated();
        // Update the training batch
        $trainingBatch->update($validatedData);
        // Redirect to the training batch show page with a success message
        return redirect()
            ->route('training_batches.show', $trainingBatch->uuid)
            ->with('success', 'Training batch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        // Delete the specified training batch
        $trainingBatch = TrainingBatch::where('uuid', $uuid)->firstOrFail();
        // Delete the training batch
        $trainingBatch->delete();
        // Redirect to the training batches index with a success message
        return redirect()
            ->route('training_batches.index')
            ->with('success', 'Training batch deleted successfully.');
    }
}
