<div>
    <div class="w-full mx-auto">
        <div class="relative bg-white rounded-lg shadow-sm border border-blue-200">

            {{-- Header --}}
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 bg-blue-50 rounded-t-lg">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        Enroll Learner — {{ $firstName . ' ' . $lastName }}
                    </h3>
                    <p class="text-sm text-gray-500 mt-0.5">
                        Choose a training course, center, and batch to enroll this learner.
                    </p>
                </div>
            </div>

            {{-- Flash Message --}}
            @if(session()->has('success'))
            <div class="m-4 p-4 text-green-800 bg-green-50 rounded-lg border border-green-200 text-sm" role="alert">
                {{ session('success') }}
            </div>
            @endif

            <form wire:submit.prevent="save">
                <div class="p-4 md:p-5 space-y-4">

                    {{-- Training Course --}}
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">
                            Training Course <span class="text-red-500">*</span>
                        </label>
                        <select wire:model.live="courseId"
                            class="bg-gray-50 border @error('courseId') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">— Select a training course —</option>
                            @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }} — {{ $course->course_code }}</option>
                            @endforeach
                        </select>
                        @error('courseId')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Training Center --}}
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700 {{ !$courseId ? 'opacity-50' : '' }}">
                            Training Center <span class="text-red-500">*</span>
                        </label>
                        <select wire:model.live="centerId" @disabled(!$courseId)
                            class="bg-gray-50 border @error('centerId') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 disabled:opacity-50 disabled:cursor-not-allowed">
                            <option value="">{{ $courseId ? '— Select a training center —' : 'Select a course first' }}</option>
                            @foreach ($centers as $center)
                            <option value="{{ $center->id }}">{{ $center->name }}</option>
                            @endforeach
                        </select>
                        @error('centerId')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Training Batch --}}
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700 {{ !$centerId ? 'opacity-50' : '' }}">
                            Training Batch <span class="text-red-500">*</span>
                        </label>
                        <select wire:model.live="batchId" @disabled(!$centerId)
                            class="bg-gray-50 border @error('batchId') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 disabled:opacity-50 disabled:cursor-not-allowed">
                            <option value="">{{ $centerId ? '— Select a training batch —' : 'Select a center first' }}</option>
                            @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}">
                                {{ $batch->batch_name }} • {{ $batch->batch_code }}
                                ({{ \Carbon\Carbon::parse($batch->start_date)->format('M d, Y') }}
                                – {{ \Carbon\Carbon::parse($batch->end_date)->format('M d, Y') }})
                            </option>
                            @endforeach
                        </select>
                        @error('batchId')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-3 p-4 md:p-5 border-t border-gray-200">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Register Application
                    </button>
                    <a href="{{ route('learner-training-applications.list.registered.applicants') }}"
                        class="py-2.5 px-5 text-sm font-medium text-gray-700 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:outline-none transition">
                        Back to List
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>