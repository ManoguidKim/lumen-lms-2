<?php

namespace Modules\PerformanceAdministration\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PerformanceAdministration\Http\Requests\CreateTrainingStudentBatchAttendanceRequest;
use Modules\PerformanceAdministration\Http\Requests\UpdateTrainingStudentBatchAttendanceRequest;
use Modules\PerformanceAdministration\Repositories\TrainingStudentBatchAttendanceRepository;

class StudentBatchAttendanceController extends Controller
{
    private $trainingStudentBatchAttendanceRepository = null;
    public function __construct(TrainingStudentBatchAttendanceRepository $trainingStudentBatchAttendanceRepository)
    {
        $this->trainingStudentBatchAttendanceRepository = $trainingStudentBatchAttendanceRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('performanceadministration.student_batch_attendance.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('performanceadministration::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTrainingStudentBatchAttendanceRequest $request)
    {
        $validatedData = $request->validated();
        $this->trainingStudentBatchAttendanceRepository->create($validatedData);
        return redirect()->route('student_batch_attendances.index')->with('success', 'Student Batch Attendance created successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($uuid)
    {
        $studentBatchAttendance = $this->trainingStudentBatchAttendanceRepository->findByUuid($uuid);
        return view('performanceadministration::show', compact('studentBatchAttendance'));
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
    public function update(UpdateTrainingStudentBatchAttendanceRequest $request, $uuid)
    {
        $validatedData = $request->validated();
        $this->trainingStudentBatchAttendanceRepository->updateByUuid($uuid, $validatedData);
        return redirect()->route('student_batch_attendances.index')->with('success', 'Student Batch Attendance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $this->trainingStudentBatchAttendanceRepository->deleteByUuid($uuid);
        return redirect()->route('student_batch_attendances.index')->with('success', 'Student Batch Attendance deleted successfully.');
    }
}
