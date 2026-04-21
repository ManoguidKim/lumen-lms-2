<?php

namespace Modules\PerformanceAdministration\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Models\TrainingBatchStudent;
use Modules\CourseAdministration\Models\TrainingCourse;
use Modules\CourseAdministration\Models\TrainingRequirement;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('performanceadministration::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($batchStudentId)
    {
        return view('performanceadministration.evaluation.student-evaluation', compact('batchStudentId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('performanceadministration::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('performanceadministration::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}

    public function trainingEvaluation($uuid)
    {
        return view('performanceadministration.evaluation.index', compact('uuid'));
    }
}
