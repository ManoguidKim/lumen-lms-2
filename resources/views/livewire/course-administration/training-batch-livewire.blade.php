<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Training Batches</h1>
            <p class="text-sm text-gray-400 mt-0.5">Manage and monitor all training batches</p>
        </div>
        <div class="flex items-center gap-3">
            <!-- Search -->
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 11 5 11a6 6 0 0112 0z" />
                </svg>
                <input
                    type="text"
                    placeholder="Search batch..."
                    wire:model.live="search"
                    class="pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg w-64 bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
            </div>
            <!-- Create Button -->
            <a href="{{ route('training_batches.create') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                New Training Batch
            </a>
        </div>
    </div>

    @if(session()->has('success'))
    <div class="m-4 md:m-5 p-4 text-green-800 bg-green-50 rounded-lg border border-green-200 dark:bg-green-900 dark:text-green-200" role="alert">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

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

    <!-- Table -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">#</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Batch</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Course</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Dates</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Participants</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Trainer</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($trainingBatches as $trainingBatch)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">

                        {{-- # --}}
                        <td class="px-5 py-4 text-xs font-mono text-gray-400">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </td>

                        {{-- Batch Code --}}
                        <td class="px-5 py-4">
                            <div class="font-semibold text-gray-800 text-sm">{{ $trainingBatch->batch_name }}</div>
                            <div class="text-xs font-mono text-gray-400 mt-0.5">{{ $trainingBatch->batch_code }}</div>
                        </td>

                        {{-- Course --}}
                        <td class="px-5 py-4">
                            <div class="font-semibold text-gray-800 text-sm">{{ $trainingBatch->course_name }}</div>
                            <div class="text-xs font-mono text-gray-400 mt-0.5">{{ $trainingBatch->course_code }}</div>
                        </td>

                        {{-- Dates --}}
                        <td class="px-5 py-4">
                            <div class="text-xs font-mono text-gray-600">{{ date('M d, Y', strtotime($trainingBatch->start_date)) }}</div>
                            <div class="text-xs font-mono text-gray-400 mt-0.5">→ {{ date('M d, Y', strtotime($trainingBatch->end_date)) }}</div>
                        </td>

                        {{-- Participants --}}
                        <td class="px-5 py-4">
                            @php
                            $pct = $trainingBatch->max_participants > 0
                            ? round(($trainingBatch->registered_students_count / $trainingBatch->max_participants) * 100)
                            : 0;
                            $barColor = $pct >= 100 ? 'bg-amber-400' : 'bg-green-500';
                            @endphp
                            <div class="text-xs font-mono text-gray-500">
                                {{ $trainingBatch->registered_students_count }} / {{ $trainingBatch->max_participants }}
                            </div>
                            <div class="mt-1.5 h-1 w-24 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full rounded-full {{ $barColor }}" style="width: {{ min($pct, 100) }}%"></div>
                            </div>
                        </td>

                        {{-- Trainer --}}
                        <td class="px-5 py-4">
                            @if($trainingBatch->trainer_name)
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-green-50 text-green-700 text-xs font-bold flex items-center justify-center shrink-0">
                                    {{ strtoupper(substr($trainingBatch->trainer_name, 0, 1)) }}{{ strtoupper(substr($trainingBatch->trainer_last_name ?? '', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">{{ $trainingBatch->trainer_name }} {{ $trainingBatch->trainer_last_name }}</div>
                                    <div class="text-xs text-gray-400 mt-0.5">{{ $trainingBatch->center_name }}</div>
                                </div>
                            </div>
                            @else
                            <span class="text-xs text-gray-400 italic">— Not assigned</span>
                            @endif
                        </td>

                        {{-- Status --}}
                        <td class="px-5 py-4">
                            @php
                            $statusStyles = [
                            'open' => 'bg-green-50 text-green-700',
                            'ongoing' => 'bg-blue-50 text-blue-700',
                            'full' => 'bg-amber-50 text-amber-700',
                            'closed' => 'bg-gray-100 text-gray-500',
                            'completed' => 'bg-gray-100 text-gray-500',
                            ];
                            $style = $statusStyles[$trainingBatch->status] ?? 'bg-gray-100 text-gray-500';
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wide {{ $style }}">
                                <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                {{ $trainingBatch->status }}
                            </span>
                        </td>

                        {{-- Action --}}
                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('training_batches.show', $trainingBatch->uuid) }}"
                                class="inline-flex items-center gap-1.5 text-xs font-semibold text-green-700 border border-green-100 bg-green-50 hover:bg-green-100 hover:border-green-300 px-3 py-1.5 rounded-lg transition-colors duration-150">
                                View
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </a>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="8" class="px-5 py-16 text-center">
                            <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-400">No training batches found</p>
                            <p class="text-xs text-gray-300 mt-1">Create a new batch to get started</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($trainingBatches->hasPages())
    <div class="mt-4">
        {{ $trainingBatches->links() }}
    </div>
    @endif
</div>