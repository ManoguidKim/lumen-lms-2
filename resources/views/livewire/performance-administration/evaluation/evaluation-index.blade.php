<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div class="flex items-start gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v-1.5a3 3 0 013-3h3a3 3 0 013 3v1.5M15.75 6.75a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0ZM6.75 8.25a1.5 1.5 0 100-3 1.5 1.5 0 000 3Zm0 0c.964 0 1.75.786 1.75 1.75v.75m8.75-2.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3Zm0 0A1.75 1.75 0 0015.5 10v.75" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 18.75h16.5" />
                </svg>
            </div>

            <div>
                <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                    Student Evaluation
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ $trainingBatch->batch_name ?? 'Training Batch' }}
                    @if(!empty($trainingBatch->batch_code))
                    <span class="mx-1 text-gray-300 dark:text-gray-600">•</span>
                    <span>{{ $trainingBatch->batch_code }}</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <div class="inline-flex items-center rounded-xl border border-gray-200 bg-white px-3 py-2 text-xs font-medium text-gray-500 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400">
                Total Students
                <span class="ml-2 rounded-lg bg-gray-100 px-2 py-1 text-gray-700 dark:bg-gray-800 dark:text-gray-200">
                    {{ count($trainingStudents) }}
                </span>
            </div>

            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search student..."
                    class="block w-full rounded-xl border border-gray-200 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-500 dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10 sm:w-72">
            </div>
        </div>
    </div>

    {{-- Card --}}
    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
        <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                        Student List
                    </h2>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Select a student to proceed with evaluation.
                    </p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-sm dark:divide-gray-800">
                <thead class="bg-gray-50/80 dark:bg-gray-800/40">
                    <tr>
                        <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 w-16">
                            #
                        </th>
                        <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Student Name
                        </th>
                        <th class="px-5 py-3 text-right text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 w-40">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse ($trainingStudents as $index => $student)
                    <tr class="transition hover:bg-gray-50/80 dark:hover:bg-gray-800/40">
                        <td class="px-5 py-4">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-xs font-semibold text-gray-600 dark:bg-gray-800 dark:text-gray-300">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </div>
                        </td>

                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-50 text-sm font-semibold text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                                    {{ strtoupper(substr($student['student_name'] ?? 'S', 0, 1)) }}
                                </div>

                                <div>
                                    <p class="font-medium capitalize text-gray-900 dark:text-white">
                                        {{ $student['student_name'] }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Student ID: {{ $student['user_id'] }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-5 py-4 text-right">
                            <a
                                href="{{ route('training_evaluation.create', ['batchStudentId' => $student['batch_student_id']]) }}"
                                class="inline-flex items-center gap-2 rounded-xl border border-indigo-200 bg-indigo-50 px-3.5 py-2 text-xs font-semibold text-indigo-700 transition hover:bg-indigo-100 dark:border-indigo-900/30 dark:bg-indigo-500/10 dark:text-indigo-300 dark:hover:bg-indigo-500/20">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 6.75h-4.5A2.25 2.25 0 004.5 9v8.25A2.25 2.25 0 006.75 19.5h10.5A2.25 2.25 0 0019.5 17.25V9A2.25 2.25 0 0017.25 6.75h-4.5m-1.5 0V5.625A1.125 1.125 0 0112.375 4.5h-.75a1.125 1.125 0 00-1.125 1.125V6.75m1.5 0h1.5" />
                                </svg>
                                Evaluate
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-16 text-center">
                            <div class="mx-auto flex max-w-sm flex-col items-center">
                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72A9.094 9.094 0 0112 21a9.094 9.094 0 01-6-2.28m12 0A8.966 8.966 0 0021 12c0-4.97-4.03-9-9-9s-9 4.03-9 9c0 2.76 1.24 5.23 3 6.72m12 0L15.75 15.75M8.25 15.75 6 18.72M9 10.5h.008v.008H9V10.5Zm6 0h.008v.008H15V10.5Z" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    No students found
                                </h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    This batch does not have enrolled students yet.
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>