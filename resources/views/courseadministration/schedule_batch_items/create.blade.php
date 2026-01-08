<x-layouts.app.flowbite>
     <div class="max-w-full mx-auto">
          <div class="bg-white rounded-lg shadow-md p-6 md:p-8">
               <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Create Training Session</h1>
                    <p class="text-gray-600 mt-1">Define a new training session for a batch</p>
               </div>

               <form action="{{ route('training_batch_schedule_items.store') }}" method="POST">
                    @csrf

                    {{-- Basic Information --}}
                    <div class="mb-6">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>

                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                              {{-- Training Batch --}}
                              <div class="md:col-span-2">
                                   <label for="training_batch_id" class="block mb-2 text-sm font-medium text-gray-900">
                                        Training Batch <span class="text-red-600">*</span>
                                   </label>
                                   <select
                                        id="training_batch_id"
                                        name="training_batch_id"
                                        class="bg-gray-50 border @error('training_batch_id') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="">Select a training batch</option>
                                        @foreach($trainingBatches as $batch)
                                        <option value="{{ $batch->id }}" {{ old('training_batch_id') == $batch->id ? 'selected' : '' }}>
                                             {{ $batch->batch_name }} - ({{ $batch->batch_code }}) - {{ date('F d, Y', strtotime($batch->start_date)) }} to {{ date('F d, Y', strtotime($batch->end_date)) }}
                                        </option>
                                        @endforeach
                                   </select>
                                   <p class="mt-1 text-xs text-gray-500">Link this session to a training batch</p>
                                   @error('training_batch_id')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Training Schedule Item (Optional) --}}
                              <div class="md:col-span-2">
                                   <label for="training_schedule_item_id" class="block mb-2 text-sm font-medium text-gray-900">
                                        Training Schedule Item <span class="text-red-600">*</span>
                                   </label>
                                   <select
                                        id="training_schedule_item_id"
                                        name="training_schedule_item_id"
                                        class="bg-gray-50 border @error('training_schedule_item_id') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="">None (Create custom session)</option>
                                        @foreach($trainingScheduleItems as $item)
                                        <option value="{{ $item->id }}" {{ old('training_schedule_item_id') == $item->id ? 'selected' : '' }}>
                                             {{ $item->name }} ({{ date('g:i A', strtotime($item->start_time)) }} - {{ date('g:i A', strtotime($item->end_time)) }})
                                        </option>
                                        @endforeach
                                   </select>
                                   <p class="mt-1 text-xs text-gray-500">Link this session to a predefined schedule</p>
                                   @error('training_schedule_item_id')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Session Title --}}
                              <div class="md:col-span-2">
                                   <label for="session_title" class="block mb-2 text-sm font-medium text-gray-900">
                                        Session Title <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="text"
                                        id="session_title"
                                        name="session_title"
                                        value="{{ old('session_title') }}"
                                        class="bg-gray-50 border @error('session_title') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="e.g. Introduction to Laravel Framework">
                                   @error('session_title')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Description --}}
                              <div class="md:col-span-2">
                                   <label for="description" class="block mb-2 text-sm font-medium text-gray-900">
                                        Description <span class="text-gray-500 text-xs">(Optional)</span>
                                   </label>
                                   <textarea
                                        id="description"
                                        name="description"
                                        rows="3"
                                        class="bg-gray-50 border @error('description') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Brief description of what will be covered in this session">{{ old('description') }}</textarea>
                                   @error('description')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Session Type --}}
                    <div class="mb-6">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Session Type</h2>

                         <div>
                              <label for="session_type" class="block mb-2 text-sm font-medium text-gray-900">
                                   Select Session Type <span class="text-red-600">*</span>
                              </label>
                              <select
                                   id="session_type"
                                   name="session_type"
                                   class="bg-gray-50 border @error('session_type') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                   <option value="">Choose a session type</option>
                                   <option value="lecture" {{ old('session_type') == 'lecture' ? 'selected' : '' }}>📚 Lecture</option>
                                   <option value="workshop" {{ old('session_type') == 'workshop' ? 'selected' : '' }}>🔧 Workshop</option>
                                   <option value="practical" {{ old('session_type') == 'practical' ? 'selected' : '' }}>💻 Practical</option>
                                   <option value="assessment" {{ old('session_type') == 'assessment' ? 'selected' : '' }}>📝 Assessment</option>
                                   <option value="group_activity" {{ old('session_type') == 'group_activity' ? 'selected' : '' }}>👥 Group Activity</option>
                                   <option value="presentation" {{ old('session_type') == 'presentation' ? 'selected' : '' }}>🎤 Presentation</option>
                              </select>
                              @error('session_type')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                         </div>
                    </div>

                    {{-- Notes --}}
                    <div class="mb-6">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Additional Notes</h2>

                         <div>
                              <label for="notes" class="block mb-2 text-sm font-medium text-gray-900">
                                   Notes <span class="text-gray-500 text-xs">(Optional)</span>
                              </label>
                              <textarea
                                   id="notes"
                                   name="notes"
                                   rows="4"
                                   class="bg-gray-50 border @error('notes') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   placeholder="Any special instructions, materials needed, or important reminders for this session">{{ old('notes') }}</textarea>
                              <p class="mt-1 text-xs text-gray-500">Include any special requirements, materials, or preparation notes</p>
                              @error('notes')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                         </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                         <button
                              type="submit"
                              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                              Create Session
                         </button>

                         <a
                              href="{{ route('training_batch_schedule_items.index') }}"
                              class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                              Cancel
                         </a>
                    </div>
               </form>
          </div>
     </div>
</x-layouts.app.flowbite>