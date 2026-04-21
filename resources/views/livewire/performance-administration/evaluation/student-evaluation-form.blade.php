<div>
    <div class="max-w-full mx-auto space-y-4">

        {{-- Header card --}}
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
            <div class="flex items-center justify-between flex-wrap gap-3 px-5 py-4 border-b border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-indigo-50 dark:bg-indigo-950 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-sm font-semibold text-gray-800 dark:text-white">Student evaluation form</h1>
                        <p class="text-xs text-gray-400 mt-0.5">Rate each training requirement from 1 to 5</p>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 border border-amber-100 dark:border-amber-800">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                    In progress
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 p-4">
                {{-- Student --}}
                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3">
                    <p class="text-xs text-gray-400 mb-2">Student</p>
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center flex-shrink-0">
                            <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-300">
                                {{ strtoupper(substr($student->full_name_searchable, 0, 1)) }}
                            </span>
                        </div>
                        <p class="text-sm font-medium text-gray-800 dark:text-white truncate">{{ $student->full_name_searchable }}</p>
                    </div>
                </div>
                {{-- Batch --}}
                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3">
                    <p class="text-xs text-gray-400 mb-1">Batch</p>
                    <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $trainingBatch->batch_name }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">
                        {{ \Carbon\Carbon::parse($trainingBatch->start_date)->format('M d') }} – {{ \Carbon\Carbon::parse($trainingBatch->end_date)->format('M d, Y') }}
                    </p>
                </div>
                {{-- Course --}}
                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3">
                    <p class="text-xs text-gray-400 mb-1">Course</p>
                    <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $trainingCourse->course_name }}</p>
                    @if(isset($trainingCourse->course_code))
                    <span class="inline-block font-mono text-xs bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 px-1.5 py-0.5 rounded mt-1">
                        {{ $trainingCourse->course_code }}
                    </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Scale guide --}}
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl px-5 py-3.5 flex items-center justify-between flex-wrap gap-3">
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-200">Scale guide</p>
                <p class="text-xs text-gray-400 mt-0.5">Select one rating per requirement</p>
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                @foreach([
                5 => ['label' => 'Very satisfactory', 'bg' => 'bg-green-50 dark:bg-green-900/30', 'text' => 'text-green-700 dark:text-green-400', 'border' => 'border-green-100 dark:border-green-800'],
                4 => ['label' => 'Satisfactory', 'bg' => 'bg-teal-50 dark:bg-teal-900/30', 'text' => 'text-teal-700 dark:text-teal-400', 'border' => 'border-teal-100 dark:border-teal-800'],
                3 => ['label' => 'Good', 'bg' => 'bg-yellow-50 dark:bg-yellow-900/30','text' => 'text-yellow-700 dark:text-yellow-400', 'border' => 'border-yellow-100 dark:border-yellow-800'],
                2 => ['label' => 'Fair', 'bg' => 'bg-orange-50 dark:bg-orange-900/30','text' => 'text-orange-700 dark:text-orange-400', 'border' => 'border-orange-100 dark:border-orange-800'],
                1 => ['label' => 'Poor', 'bg' => 'bg-red-50 dark:bg-red-900/30', 'text' => 'text-red-700 dark:text-red-400', 'border' => 'border-red-100 dark:border-red-800'],
                ] as $score => $style)
                <div class="flex items-center gap-1.5">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold border {{ $style['bg'] }} {{ $style['text'] }} {{ $style['border'] }}">{{ $score }}</span>
                    <span class="text-xs text-gray-500 dark:text-gray-400 hidden sm:inline">{{ $style['label'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Flash --}}
        @if(session()->has('success'))
        <div class="flex items-center gap-2 px-4 py-3 text-sm text-green-700 dark:text-green-300 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- Validation errors --}}
        @if($errors->any())
        <div class="flex items-start gap-2 px-4 py-3 text-sm text-red-700 dark:text-red-300 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
            <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
            <div>
                <p class="font-medium mb-1">Please fix the following:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- Evaluation table --}}
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-800/60 border-b border-gray-100 dark:border-gray-800">
                            <th class="px-4 py-2.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider w-10 border-r border-gray-100 dark:border-gray-800">#</th>
                            <th class="px-4 py-2.5 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider border-r border-gray-100 dark:border-gray-800">Requirement</th>
                            @foreach([
                            5 => ['bg' => 'bg-green-50 dark:bg-green-950', 'pill' => 'bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300'],
                            4 => ['bg' => 'bg-teal-50 dark:bg-teal-950', 'pill' => 'bg-teal-100 dark:bg-teal-900 text-teal-700 dark:text-teal-300'],
                            3 => ['bg' => 'bg-yellow-50 dark:bg-yellow-950','pill' => 'bg-yellow-100 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-300'],
                            2 => ['bg' => 'bg-orange-50 dark:bg-orange-950','pill' => 'bg-orange-100 dark:bg-orange-900 text-orange-700 dark:text-orange-300'],
                            1 => ['bg' => 'bg-red-50 dark:bg-red-950', 'pill' => 'bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300'],
                            ] as $score => $style)
                            <th class="w-14 px-2 py-2.5 text-center {{ $style['bg'] }} border-r border-gray-100 dark:border-gray-800 last:border-r-0">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-semibold {{ $style['pill'] }}">
                                    {{ $score }}
                                </span>
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                        @forelse($trainingRequirements as $index => $requirement)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors">
                            <td class="px-4 py-3.5 text-xs text-gray-300 dark:text-gray-600 font-medium border-r border-gray-100 dark:border-gray-800 align-top">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-4 py-3.5 border-r border-gray-100 dark:border-gray-800">
                                <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $requirement->requirement_name }}</p>
                                @if(!empty($requirement->requirement_description))
                                <p class="mt-1 text-xs text-gray-400 italic leading-relaxed">{{ $requirement->requirement_description }}</p>
                                @endif
                            </td>
                            @foreach([5,4,3,2,1] as $score)
                            <td class="w-14 px-2 py-3.5 text-center border-r border-gray-50 dark:border-gray-800 last:border-r-0">
                                <input
                                    type="radio"
                                    id="rating_{{ $requirement->id }}_{{ $score }}"
                                    name="ratings[{{ $requirement->id }}]"
                                    wire:model.live="ratings.{{ $requirement->id }}"
                                    value="{{ $score }}"
                                    class="w-4 h-4 text-indigo-600 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 cursor-pointer">
                            </td>
                            @endforeach
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center">
                                <div class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-gray-800 flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-gray-400">No training requirements found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-between px-5 py-3.5 border-t border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/40">
                <p class="text-xs text-gray-400">
                    {{ collect($ratings)->filter()->count() }} of {{ $trainingRequirements->count() }} items rated
                </p>
                <div class="flex items-center gap-2">
                    <a href="{{ url()->previous() }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        Back
                    </a>
                    <button wire:click="save" wire:loading.attr="disabled" wire:target="save"
                        class="inline-flex items-center gap-2 px-5 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 disabled:opacity-60 rounded-lg transition">
                        <svg wire:loading.remove wire:target="save" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <svg wire:loading wire:target="save" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        Save evaluation
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>