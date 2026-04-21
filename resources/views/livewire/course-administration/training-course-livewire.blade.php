<div class="mx-auto max-w-full">
    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

        {{-- Header --}}
        <div class="border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-white px-6 py-5 dark:border-gray-800 dark:from-indigo-500/10 dark:to-gray-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            Training Courses
                        </h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Manage and monitor all training courses
                        </p>
                    </div>
                </div>

                <a href="{{ route('training_courses.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    New Course
                </a>
            </div>
        </div>

        <div class="space-y-6 px-6 py-6">

            {{-- Alerts --}}
            @if(session()->has('success'))
            <div class="flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 shadow-sm dark:border-emerald-900/40 dark:bg-emerald-500/10 dark:text-emerald-300">
                <div class="mt-0.5 flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-100 dark:bg-emerald-500/10">
                    <svg class="h-4 w-4 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold">Success</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            @if(session()->has('error'))
            <div class="flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-800 shadow-sm dark:border-red-900/40 dark:bg-red-500/10 dark:text-red-300">
                <div class="mt-0.5 flex h-9 w-9 items-center justify-center rounded-xl bg-red-100 dark:bg-red-500/10">
                    <svg class="h-4 w-4 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-7-4a1 1 0 10-2 0v4a1 1 0 102 0V6zm-1 8a1.25 1.25 0 100-2.5A1.25 1.25 0 0010 14z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold">Error</p>
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
            </div>
            @endif

            {{-- Stats --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-indigo-500 dark:text-indigo-400">
                                Total Courses
                            </p>
                            <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $courses->total() }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Across all centers
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-5 h-1.5 rounded-full bg-indigo-50 dark:bg-indigo-500/10">
                        <div class="h-1.5 w-3/4 rounded-full bg-indigo-500"></div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-emerald-500 dark:text-emerald-400">
                                TESDA Courses
                            </p>
                            <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $courses->where('is_tesda_course', true)->count() }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Nationally recognized
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-5 h-1.5 rounded-full bg-emerald-50 dark:bg-emerald-500/10">
                        <div class="h-1.5 w-2/3 rounded-full bg-emerald-500"></div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-violet-500 dark:text-violet-400">
                                Avg. Duration
                            </p>
                            <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $courses->count() ? round($courses->avg('duration_hours')) : 0 }}
                                <span class="text-base font-medium text-gray-400">hrs</span>
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Per course
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 dark:bg-violet-500/10 dark:text-violet-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-5 h-1.5 rounded-full bg-violet-50 dark:bg-violet-500/10">
                        <div class="h-1.5 w-1/2 rounded-full bg-violet-500"></div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-amber-500 dark:text-amber-400">
                                With Centers
                            </p>
                            <p class="mt-3 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $courses->filter(fn($c) => $c->center_names)->count() }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Assigned to a center
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 21V7.5l8.25-4.5L21 7.5V21M9 21V12h7.5v9" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-5 h-1.5 rounded-full bg-amber-50 dark:bg-amber-500/10">
                        <div class="h-1.5 w-1/3 rounded-full bg-amber-500"></div>
                    </div>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                                Course Directory
                            </h2>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                View course profile, duration, type, training regulation number, and linked centers.
                            </p>
                        </div>

                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" />
                                </svg>
                            </div>
                            <input
                                type="text"
                                placeholder="Search course..."
                                wire:model.live="search"
                                class="block w-full rounded-2xl border border-gray-200 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10 sm:w-64">
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 text-sm dark:divide-gray-800">
                        <thead class="bg-gray-50/80 dark:bg-gray-800/40">
                            <tr>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 w-14">
                                    #
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Course
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Duration
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Type
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    TR No.
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Centers
                                </th>
                                <th class="px-5 py-3 text-right text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 w-40">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white dark:divide-gray-800 dark:bg-gray-900">
                            @forelse ($courses as $course)
                            <tr class="transition hover:bg-gray-50/80 dark:hover:bg-gray-800/40">
                                <td class="px-5 py-4">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-xs font-semibold text-gray-600 dark:bg-gray-800 dark:text-gray-300">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-start gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                            </svg>
                                        </div>

                                        <div class="min-w-0">
                                            <p class="font-semibold text-gray-900 dark:text-white">
                                                {{ $course->course_name }}
                                            </p>
                                            <p class="mt-1 text-xs font-mono text-gray-400 dark:text-gray-500">
                                                {{ $course->course_code }}
                                            </p>
                                            @if($course->description)
                                            <p class="mt-1 max-w-xs text-xs leading-relaxed text-gray-500 dark:text-gray-400 line-clamp-2">
                                                {{ $course->description }}
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <p class="font-medium text-gray-800 dark:text-gray-100">
                                        {{ $course->duration_hours }} hrs
                                    </p>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        ~{{ ceil($course->duration_hours / 40) }} weeks
                                    </p>
                                </td>

                                <td class="px-5 py-4">
                                    @if($course->is_tesda_course)
                                    <span class="inline-flex items-center gap-1 rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-500/10 dark:text-emerald-300">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        TESDA
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1 rounded-full border border-amber-200 bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700 dark:border-amber-900/40 dark:bg-amber-500/10 dark:text-amber-300">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                                        Non-TESDA
                                    </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    @if($course->tr_number)
                                    <span class="text-sm font-mono text-gray-600 dark:text-gray-300">
                                        {{ $course->tr_number }}
                                    </span>
                                    @else
                                    <span class="text-xs text-gray-400 dark:text-gray-500">—</span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    @if($course->center_names)
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach(explode(',', $course->center_names) as $center)
                                        <span class="inline-flex items-center rounded-full border border-indigo-200 bg-indigo-50 px-2.5 py-1 text-xs font-medium text-indigo-700 dark:border-indigo-900/40 dark:bg-indigo-500/10 dark:text-indigo-300">
                                            {{ trim($center) }}
                                        </span>
                                        @endforeach
                                    </div>
                                    @else
                                    <span class="text-xs text-gray-400 dark:text-gray-500">No center</span>
                                    @endif
                                </td>

                                <td class="px-5 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('training_courses.requirements', $course->uuid) }}"
                                            class="inline-flex items-center gap-1.5 rounded-xl border border-indigo-200 bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700 transition hover:bg-indigo-100 dark:border-indigo-900/40 dark:bg-indigo-500/10 dark:text-indigo-300 dark:hover:bg-indigo-500/20">
                                            Requirements
                                        </a>

                                        <a href="{{ route('training_courses.show', $course->uuid) }}"
                                            class="inline-flex items-center gap-1.5 rounded-xl border border-gray-200 bg-gray-50 px-3 py-1.5 text-xs font-semibold text-gray-700 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                            View
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-5 py-16 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center">
                                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500">
                                            <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                            No training courses found
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            Try adjusting your search or create a new course.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($courses->hasPages())
                <div class="border-t border-gray-100 px-5 py-4 dark:border-gray-800">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-xs text-gray-400 dark:text-gray-500">
                            Showing {{ $courses->firstItem() }}–{{ $courses->lastItem() }} of {{ $courses->total() }} courses
                        </p>
                        <div>
                            {{ $courses->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>