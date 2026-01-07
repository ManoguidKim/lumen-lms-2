<x-layouts.app.flowbite>

     <div class="max-w-full mx-auto">
          <div class="bg-white rounded-lg shadow-md p-6 md:p-8">
               <div class="mb-6 flex justify-between items-start">
                    <div>
                         <h1 class="text-2xl font-bold text-gray-900">Training Batch Update</h1>
                         <p class="text-gray-600 mt-1">Update the details of the training batch</p>
                    </div>
                    <div class="flex gap-2">
                         <button type="submit" form="update-batch-form" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                              Update
                         </button>
                         <button type="button" onclick="confirmDelete()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                              Delete
                         </button>
                    </div>
               </div>

               {{-- Success Message --}}
               @if(session('success'))
               <div class="mb-4 p-4 text-green-800 bg-green-50 rounded-lg" role="alert">
                    {{ session('success') }}
               </div>
               @endif

               <form id="update-batch-form" action="{{ route('training_batches.update', $trainingBatch->uuid) }}" method="POST">

                    @csrf
                    @method('PUT')

                    {{-- Basic Information --}}
                    <div class="mb-6">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                              {{-- Training Course --}}
                              <div class="md:col-span-2">
                                   <label for="training_course_id" class="block mb-2 text-sm font-medium text-gray-900">
                                        Training Course <span class="text-red-600">*</span>
                                   </label>
                                   <select
                                        id="training_course_id"
                                        name="training_course_id"
                                        class="bg-gray-50 border @error('training_course_id') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="">Select training course</option>
                                        @foreach($trainingCourses as $course)
                                        <option value="{{ $course->id }}" {{ old('training_course_id', $trainingBatch->training_course_id) == $course->id ? 'selected' : '' }}>
                                             {{ $course->course_name }}
                                        </option>
                                        @endforeach
                                   </select>
                                   @error('training_course_id')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Batch Code --}}
                              <div>
                                   <label for="batch_code" class="block mb-2 text-sm font-medium text-gray-900">
                                        Batch Code <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="text"
                                        id="batch_code"
                                        name="batch_code"
                                        value="{{ old('batch_code', $trainingBatch->batch_code) }}"
                                        class="bg-gray-50 border @error('batch_code') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter batch code">
                                   @error('batch_code')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Batch Name --}}
                              <div>
                                   <label for="batch_name" class="block mb-2 text-sm font-medium text-gray-900">
                                        Batch Name <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="text"
                                        id="batch_name"
                                        name="batch_name"
                                        value="{{ old('batch_name', $trainingBatch->batch_name) }}"
                                        class="bg-gray-50 border @error('batch_name') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter batch name">
                                   @error('batch_name')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Start Date --}}
                              <div>
                                   <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">
                                        Start Date <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="date"
                                        id="start_date"
                                        name="start_date"
                                        value="{{ old('start_date', date('Y-m-d', strtotime($trainingBatch->start_date))) }}"
                                        class="bg-gray-50 border @error('start_date') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                   @error('start_date')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- End Date --}}
                              <div>
                                   <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">
                                        End Date <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="date"
                                        id="end_date"
                                        name="end_date"
                                        value="{{ old('end_date', date('Y-m-d', strtotime($trainingBatch->end_date))) }}"
                                        class="bg-gray-50 border @error('end_date') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                   @error('end_date')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Max Participants --}}
                              <div>
                                   <label for="max_participants" class="block mb-2 text-sm font-medium text-gray-900">
                                        Max Participants <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="number"
                                        id="max_participants"
                                        name="max_participants"
                                        value="{{ old('max_participants', $trainingBatch->max_participants) }}"
                                        min="0"
                                        class="bg-gray-50 border @error('max_participants') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter max participants">
                                   @error('max_participants')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Status --}}
                              <div>
                                   <label for="status" class="block mb-2 text-sm font-medium text-gray-900">
                                        Status <span class="text-red-600">*</span>
                                   </label>
                                   <select
                                        id="status"
                                        name="status"
                                        class="bg-gray-50 border @error('status') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="">Select status</option>
                                        <option value="open" {{ old('status', $trainingBatch->status) == 'open' ? 'selected' : '' }}>Open</option>
                                        <option value="full" {{ old('status', $trainingBatch->status) == 'full' ? 'selected' : '' }}>Full</option>
                                        <option value="ongoing" {{ old('status', $trainingBatch->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                        <option value="completed" {{ old('status', $trainingBatch->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ old('status', $trainingBatch->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                   </select>
                                   @error('status')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Trainer Information --}}
                    <div class="mb-6">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Trainer Information</h2>
                         <div>
                              <label for="trainer_id" class="block mb-2 text-sm font-medium text-gray-900">
                                   Assigned Trainer
                              </label>
                              <select
                                   id="trainer_id"
                                   name="trainer_id"
                                   class="bg-gray-50 border @error('trainer_id') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                   <option value="">Select trainer (optional)</option>
                                   @foreach($trainers as $trainer)
                                   <option value="{{ $trainer->id }}" {{ old('trainer_id', $trainingBatch->trainer_id) == $trainer->id ? 'selected' : '' }}>
                                        {{ $trainer->name }}
                                   </option>
                                   @endforeach
                              </select>
                              @error('trainer_id')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                         </div>
                    </div>

                    {{-- Additional Information --}}
                    <div class="mb-6">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Additional Information</h2>
                         <div>
                              <label for="notes" class="block mb-2 text-sm font-medium text-gray-900">
                                   Notes
                              </label>
                              <textarea
                                   id="notes"
                                   name="notes"
                                   rows="4"
                                   class="bg-gray-50 border @error('notes') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   placeholder="Enter any additional notes or comments">{{ old('notes', $trainingBatch->notes) }}</textarea>
                              @error('notes')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                         </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                         <a
                              href="{{ route('training_batches.index') }}"
                              class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                              Cancel
                         </a>
                    </div>
               </form>

               {{-- Hidden Delete Form --}}
               <form id="delete-batch-form" action="{{ route('training_batches.destroy', $trainingBatch->uuid) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
               </form>
          </div>
     </div>

     {{-- Delete Confirmation Script --}}
     <script>
          function confirmDelete() {
               if (confirm('Are you sure you want to delete this training batch? This action cannot be undone.')) {
                    document.getElementById('delete-batch-form').submit();
               }
          }
     </script>
</x-layouts.app.flowbite>