<?php

namespace Modules\CourseAdministration\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CourseAdministration\Http\Requests\CreateTrainingCourseRequest;
use Modules\CourseAdministration\Http\Requests\UpdateTrainingCourseRequest;
use Modules\CourseAdministration\Models\TrainingCourse;

class TrainingCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('courseadministration.training_course.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courseadministration.training_course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTrainingCourseRequest $request)
    {
        // Validate the request data
        $trainingCourse = TrainingCourse::create([
            'course_code' => $request->input('course_code'),
            'course_name' => $request->input('course_name'),
            'description' => $request->input('description'),
            'duration_hours' => $request->input('duration_hours'),
            'status' => $request->input('status'),
            'is_tesda_course' => $request->input('is_tesda_course'),
            'tr_number' => $request->input('tr_number'),
            'center_id' => 1
        ]);

        // Redirect to the training courses index with a success message
        return redirect()->route('training_courses.index')
            ->with('success', 'Training course created successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($uuid)
    {
        // Retrieve the training course by UUID
        $course = TrainingCourse::where('uuid', $uuid)->firstOrFail();
        return view('courseadministration.training_course.view', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        // Retrieve the training course by UUID
        // return view('courseadministration::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingCourseRequest $request, $uuid)
    {
        // Retrieve the training course by UUID
        // dd('update function called' . $uuid);
        $course = TrainingCourse::where('uuid', $uuid)->firstOrFail();
        // Update the training course with validated data
        $course->update($request->validated());

        return redirect()->route('training_courses.show', $course->uuid)
            ->with('success', 'Training course updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        // Retrieve the training course by UUID
        $course = TrainingCourse::where('uuid', $uuid)->firstOrFail();
        // Delete the training course
        $course->delete();
        return redirect()->route('training_courses.index')
            ->with('success', 'Training course deleted successfully.');
    }
}
