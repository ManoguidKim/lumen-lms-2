<x-layouts.app.flowbite>

     <div class="max-w-full mx-auto">
          <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
               {{-- Header --}}
               <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 bg-blue-50 dark:bg-gray-600">
                    <div>
                         <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                              Register Training Batch
                         </h3>
                         <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                              Fill the details of the training batch
                         </p>
                    </div>
               </div>

               {{-- Success Message --}}
               @if(session('success'))
               <div class="m-4 md:m-5 p-4 text-green-800 bg-green-50 rounded-lg" role="alert">
                    {{ session('success') }}
               </div>
               @endif

               <form action="{{ route('training_batches.store') }}" method="POST">

                    @csrf

                    {{-- Basic Information --}}
                    <div class="p-4 md:p-5 space-y-4">
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
                                        <option value="{{ $course->id }}" {{ old('training_course_id') == $course->id ? 'selected' : '' }}>
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
                                        value="{{ old('batch_code') }}"
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
                                        value="{{ old('batch_name') }}"
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
                                        value="{{ old('start_date') }}"
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
                                        value="{{ old('end_date') }}"
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
                                        value="{{ old('max_participants') }}"
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
                                        <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                                        <option value="full" {{ old('status') == 'full' ? 'selected' : '' }}>Full</option>
                                        <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                   </select>
                                   @error('status')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    <div class="p-4 md:p-5 space-y-4">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Batch Schedule Information</h2>
                         <div>
                              <label for="trainer_id" class="block mb-2 text-sm font-medium text-gray-900">
                                   Assigned Schedule
                              </label>
                              <select
                                   id="training_schedule_item_id"
                                   name="training_schedule_item_id"
                                   class="bg-gray-50 border @error('training_schedule_item_id') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                   <option value="">Select schedule</option>
                                   @foreach($trainigScheduleItems as $schedule)
                                   <option value="{{ $schedule->id }}" {{ old('training_schedule_item_id') == $schedule->id ? 'selected' : '' }}>
                                        {{ $schedule->name }}
                                        @if($schedule->schedule_days)
                                        - {{ is_array($schedule->schedule_days) ? implode(', ', $schedule->schedule_days) : $schedule->schedule_days }}
                                        @endif
                                        @if($schedule->start_time && $schedule->end_time)
                                        ({{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }})
                                        @endif
                                   </option>
                                   @endforeach
                              </select>
                              @error('training_schedule_item_id')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                         </div>
                    </div>

                    {{-- Trainer Information --}}
                    <div class="p-4 md:p-5 space-y-4">
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
                                   <option value="{{ $trainer->id }}" {{ old('trainer_id') == $trainer->id ? 'selected' : '' }}>
                                        {{ $trainer->name }} {{ $trainer->last_name }}
                                   </option>
                                   @endforeach
                              </select>
                              @error('trainer_id')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                         </div>
                    </div>

                    @if (auth()->user()->hasRole('Super Admin'))
                    {{-- Center Information --}}
                    <div class="p-4 md:p-5 space-y-4">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Center Information</h2>
                         <div>
                              <label for="center_id" class="block mb-2 text-sm font-medium text-gray-900">
                                   Assigned Center
                              </label>
                              <select
                                   id="center_id"
                                   name="center_id"
                                   class="bg-gray-50 border @error('center_id') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                   <option value="">Select center (optional)</option>
                                   @foreach($centers as $center)
                                   <option value="{{ $center->id }}" {{ old('center_id') == $center->id ? 'selected' : '' }}>
                                        {{ $center->name }}
                                   </option>
                                   @endforeach
                              </select>
                              @error('center_id')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                         </div>
                    </div>
                    @endif

                    {{-- Additional Information --}}
                    <div class="p-4 md:p-5 space-y-4">
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
                                   placeholder="Enter any additional notes or comments">{{ old('notes') }}</textarea>
                              @error('notes')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                         </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                         <button
                              type="submit"
                              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                              Register Training Batch
                         </button>

                         <a href="{{ route('training_batches.index') }}"
                              class="py-2.5 px-5 ml-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                              Cancel
                         </a>
                    </div>
               </form>
          </div>
     </div>
</x-layouts.app.flowbite>