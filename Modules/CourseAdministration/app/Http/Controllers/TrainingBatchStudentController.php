<?php

namespace Modules\CourseAdministration\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CourseAdministration\Http\Requests\CreateTrainingBatchStudentRequest;
use Modules\CourseAdministration\Http\Requests\UpdateTrainingBatchStudentRequest;

class TrainingBatchStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('courseadministration.training_batch_students.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courseadministration.training_batch_students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTrainingBatchStudentRequest $request) {}

    /**
     * Show the specified resource.
     */
    public function show($uuid)
    {
        return view('courseadministration.training_batch_students.view');
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
    public function update(UpdateTrainingBatchStudentRequest $request, $uuid) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
