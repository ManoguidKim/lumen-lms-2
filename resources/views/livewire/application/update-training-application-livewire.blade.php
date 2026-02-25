<div>
    <div class="max-w-full mx-auto">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            {{-- Header --}}
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50 dark:bg-gradient-to-r dark:from-gray-700 dark:to-gray-600">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Update Training Application
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                        Update your training application details
                    </p>
                </div>
            </div>

            @if(session()->has('error'))
            <div class="m-4 md:m-5 p-4 text-red-800 bg-red-50 rounded-lg border border-red-200 dark:bg-red-900 dark:text-red-200" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
            @endif

            {{-- Training Center & Course Selection --}}
            <div class="p-4 md:p-5 space-y-4 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center gap-2 mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Training Selection</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Training Course --}}
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Training Course <span class="text-red-500">*</span>
                        </label>
                        <select
                            wire:model.live="training_course_id"
                            class="bg-gray-50 border @error('training_course_id') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            <option value="">Select training course</option>
                            @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }} - {{ $course->course_code }}</option>
                            @endforeach
                        </select>
                        @error('training_course_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Center Selection --}}
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Training Center <span class="text-red-500">*</span>
                        </label>
                        <select
                            wire:model.live="center_id"
                            @disabled(!$training_course_id)
                            class="bg-gray-50 border @error('center_id') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white disabled:opacity-50 disabled:cursor-not-allowed">
                            <option value="">{{ $training_course_id ? 'Select training center' : 'Select a course first' }}</option>
                            @foreach ($centers as $center)
                            <option value="{{ $center->id }}">{{ $center->name }}</option>
                            @endforeach
                        </select>
                        @error('center_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Additional Information --}}
            <div class="p-4 md:p-5 space-y-4 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center gap-2 mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Additional Information</h2>
                </div>

                <div>
                    <label for="learner_remarks" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Remarks / Notes (Optional)
                    </label>
                    <textarea
                        id="learner_remarks"
                        wire:model="learner_remarks"
                        rows="4"
                        maxlength="1000"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                        placeholder="Any additional information, questions, or special requests..."
                        @if($status && $status !=='pending' ) disabled @endif></textarea>
                    @error('learner_remarks')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <div class="flex justify-between mt-1">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Share any relevant information that may help with your application</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ strlen($learner_remarks ?? '') }}/1000</p>
                    </div>
                </div>
            </div>


            <div class="flex flex-wrap items-center gap-3 p-4 md:p-5 border-t border-gray-200 dark:border-gray-600 rounded-b">

                @if($status === 'pending')
                <button wire:click.prevent="save" wire:confirm="Are you sure you want to update this application?"
                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 transition-all duration-150 transform hover:scale-105">
                    <svg class="w-4 h-4 inline mr-2 -mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Update Application
                </button>
                @endif

                @if($status === 'pending')
                <button wire:click.prevent="cancelApplication" wire:confirm="Are you sure you want to cancel this application? This action cannot be undone."
                    class="text-white bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 transition-all duration-150 transform hover:scale-105">
                    <svg class="w-4 h-4 inline mr-2 -mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Cancel Application
                </button>
                @endif

                <a
                    href="{{ route('learner-training-applications.index') }}"
                    class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                    <svg class="w-4 h-4 inline mr-2 -mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to List
                </a>
            </div>
        </div>
    </div>
</div>