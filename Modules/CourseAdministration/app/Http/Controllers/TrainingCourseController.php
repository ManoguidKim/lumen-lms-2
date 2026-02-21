<?php

namespace Modules\CourseAdministration\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CourseAdministration\Http\Requests\CreateTrainingCourseRequest;
use Modules\CourseAdministration\Http\Requests\UpdateTrainingCourseRequest;
use Modules\CourseAdministration\Models\CenterCourse;
use Modules\CourseAdministration\Models\TrainingCenterCourse;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\Institution\Models\Center;

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
        $courseCenters = Center::all();
        return view('courseadministration.training_course.create', compact('courseCenters'));
    }

    public function selectCenter($uuid)
    {
        $trainingcourse = TrainingCourse::where('uuid', $uuid)->firstOrFail();
        $center = Center::all();

        return view('courseadministration.training_course.select-center-course', compact('center', 'trainingcourse'));
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
        ]);

        $selectedCenterIds = $request->input('course_center_id');
        foreach ($selectedCenterIds as $centerId) {
            TrainingCenterCourse::create([
                'training_course_id' => $trainingCourse->id,
                'center_id' => $centerId,
            ]);
        }

        // Redirect to the training courses index with a success message
        return redirect()->route('training_courses.index')
            ->with('success', 'Training course created successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($uuid)
    {
        $course = TrainingCourse::where('uuid', $uuid)->firstOrFail();
        // Fetch all centers
        $courseCenters = Center::all();
        // Get the IDs of centers already assigned to this course where is_active = 1
        $selectedCenterIds = $course->centers()
            ->wherePivot('is_active', 1)
            ->pluck('centers.id')
            ->toArray();

        return view('courseadministration.training_course.view', compact('course', 'courseCenters', 'selectedCenterIds'));
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
        // Update course details
        $course->update($request->except('course_center_id'));

        // Get currently assigned center IDs
        $existingCenterIds = $course->centers()->pluck('centers.id')->toArray();

        // Get newly selected center IDs (empty array if none selected)
        $selectedCenterIds = $request->input('course_center_id', []);

        // Deselected centers = was assigned before but not in new selection
        $deselectedCenterIds = array_diff($existingCenterIds, $selectedCenterIds);

        // Newly selected centers = not assigned before but in new selection
        $newlySelectedCenterIds = array_diff($selectedCenterIds, $existingCenterIds);

        // Set is_active = 0 for deselected centers
        if (!empty($deselectedCenterIds)) {
            $course->centers()->wherePivotIn('center_id', $deselectedCenterIds)
                ->updateExistingPivot($deselectedCenterIds, ['is_active' => 0]);
        }

        // Set is_active = 1 for newly selected centers (attach if not exists, update if exists)
        foreach ($newlySelectedCenterIds as $centerId) {
            $course->centers()->syncWithoutDetaching([
                $centerId => ['is_active' => 1]
            ]);
        }

        // Re-activate centers that were inactive but are now selected again
        $reactivatedCenterIds = array_intersect($selectedCenterIds, $existingCenterIds);
        if (!empty($reactivatedCenterIds)) {
            foreach ($reactivatedCenterIds as $centerId) {
                $course->centers()->updateExistingPivot($centerId, ['is_active' => 1]);
            }
        }

        return redirect()->route('training_courses.index')
            ->with('success', 'Training course updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $course = TrainingCourse::where('uuid', $uuid)->firstOrFail();
        // Check if course has any active centers
        $hasActiveCenters = $course->centers()->wherePivot('is_active', 1)->exists();
        if ($hasActiveCenters) {
            return redirect()->route('training_courses.index')
                ->with('error', 'Cannot delete this course because it is still assigned to active centers.');
        }
        $course->delete();

        return redirect()->route('training_courses.index')
            ->with('success', 'Training course deleted successfully.');
    }
}
