<?php

namespace Modules\CourseAdministration\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CourseAdministration\Http\Requests\CreateTrainingBatchScheduleItemRequest;
use Modules\CourseAdministration\Models\TrainingBatch;
use Modules\CourseAdministration\Repositories\TrainingBatchRepository;
use Modules\CourseAdministration\Repositories\TrainingBatchScheduleItemRepository;
use Modules\CourseAdministration\Repositories\TrainingScheduleItemRepository;

class TrainingBatchScheduleItemController extends Controller
{
    // Dependency Injection
    private $trainingBatchScheduleItemRepository = null;
    private $trainingScheduleItemRepository = null;
    private $trainingBatchRepository = null;
    // Constructor
    public function __construct(
        TrainingBatchScheduleItemRepository $trainingBatchScheduleItemRepository,
        TrainingScheduleItemRepository $trainingScheduleItemRepository,
        TrainingBatchRepository $trainingBatchRepository
    ) {
        // Dependency Injection
        $this->trainingBatchScheduleItemRepository = $trainingBatchScheduleItemRepository;
        $this->trainingScheduleItemRepository = $trainingScheduleItemRepository;
        $this->trainingBatchRepository = $trainingBatchRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('courseadministration.schedule_batch_items.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get necessary data for the form
        $trainingBatches = $this->trainingBatchRepository->all();
        $trainingScheduleItems = $this->trainingScheduleItemRepository->all();
        // Return the create view with data
        return view('courseadministration.schedule_batch_items.create', compact('trainingBatches', 'trainingScheduleItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTrainingBatchScheduleItemRequest $request)
    {
        // Validate and get the validated data
        $validatedData = $request->validated();
        // Create the training batch schedule item
        $trainingBatchScheduleItem = $this->trainingBatchScheduleItemRepository->create($validatedData);
        // Redirect to the show page with success message
        return redirect()->route('training_batch_schedule_items.index')
            ->with('success', 'Training Batch Schedule Item created successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($uuid)
    {
        // Find the training batch schedule item by UUID
        $trainingBatchScheduleItem = $this->trainingBatchScheduleItemRepository->findByUuid($uuid);
        // Get necessary data for the form
        $trainingBatches = $this->trainingBatchRepository->all();
        $trainingScheduleItems = $this->trainingScheduleItemRepository->all();

        return view('courseadministration.schedule_batch_items.view', compact('trainingBatchScheduleItem', 'trainingBatches', 'trainingScheduleItems'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('courseadministration::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
