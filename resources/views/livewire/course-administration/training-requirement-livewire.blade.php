<div class="mx-auto max-w-full">
    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

        {{-- Header --}}
        <div class="border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-white px-6 py-5 dark:border-gray-800 dark:from-indigo-500/10 dark:to-gray-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 21V7.125a1.125 1.125 0 00-.659-1.024l-6.75-3a1.125 1.125 0 00-.932 0l-6.75 3A1.125 1.125 0 003.75 7.125V21m15.75 0h-15m15 0h1.5m-16.5 0H3m3.75-9h10.5m-10.5 4.5h10.5M8.25 21v-3.375c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            {{ $courseName }} - Training Requirements
                        </h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Define and manage the required documents or prerequisites for this course.
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center rounded-2xl border border-gray-200 bg-white px-3 py-2 text-xs text-gray-500 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400">
                        Total:
                        <span class="ml-1 font-semibold text-gray-700 dark:text-gray-200">{{ count($requirements) }}</span>
                    </div>

                    <button
                        wire:click="addRequirement"
                        class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-950">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Add Requirement
                    </button>
                </div>
            </div>
        </div>

        <div class="space-y-6 px-6 py-6">

            {{-- Alert --}}
            @if(session()->has('success'))
            <div class="flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 shadow-sm dark:border-green-900/50 dark:bg-green-500/10 dark:text-green-300">
                <div class="mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.643a.75.75 0 10-1.214-.882l-3.21 4.414-1.79-1.79a.75.75 0 10-1.06 1.061l2.4 2.4a.75.75 0 001.137-.09l3.737-5.113z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="font-medium">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
            @endif

            {{-- Table Card --}}
            <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

                {{-- Top bar --}}
                <div class="flex flex-col gap-3 border-b border-gray-100 px-5 py-4 dark:border-gray-800 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                            Requirement List
                        </h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Add the requirement name and a short description for each item.
                        </p>
                    </div>

                    <div class="text-xs text-gray-400 dark:text-gray-500">
                        Changes are saved when you click
                        <span class="font-medium text-gray-600 dark:text-gray-300">Save Changes</span>
                    </div>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 text-sm dark:divide-gray-800">
                        <thead class="bg-gray-50/80 dark:bg-gray-800/40">
                            <tr>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 w-16">
                                    #
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Requirement Name
                                </th>
                                <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Description
                                </th>
                                <th class="px-5 py-3 text-right text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 w-28">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse ($requirements as $index => $req)
                            <tr class="align-top transition hover:bg-gray-50/70 dark:hover:bg-gray-800/40">
                                {{-- # --}}
                                <td class="px-5 py-4">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-xs font-semibold text-gray-600 dark:bg-gray-800 dark:text-gray-300">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </div>
                                </td>

                                {{-- Name --}}
                                <td class="px-5 py-4">
                                    <div class="space-y-1.5">
                                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">
                                            Requirement
                                        </label>
                                        <input
                                            type="text"
                                            wire:model="requirements.{{ $index }}.requirement_name"
                                            placeholder="e.g. Training course related questions"
                                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 dark:placeholder:text-gray-500 dark:focus:border-indigo-400 dark:focus:bg-gray-900">
                                        @error("requirements.$index.requirement_name")
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </td>

                                {{-- Description --}}
                                <td class="px-5 py-4">
                                    <div class="space-y-1.5">
                                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">
                                            Description
                                        </label>
                                        <input
                                            type="text"
                                            wire:model="requirements.{{ $index }}.requirement_description"
                                            placeholder="Short details about this requirement"
                                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 dark:placeholder:text-gray-500 dark:focus:border-indigo-400 dark:focus:bg-gray-900">
                                        @error("requirements.$index.requirement_description")
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </td>

                                {{-- Action --}}
                                <td class="px-5 py-4 text-right">
                                    <button
                                        type="button"
                                        wire:click="removeRequirement({{ $index }})"
                                        class="inline-flex items-center gap-1 rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs font-medium text-red-600 transition hover:bg-red-100 dark:border-red-900/40 dark:bg-red-500/10 dark:text-red-400 dark:hover:bg-red-500/20">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Remove
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-14 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center">
                                        <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M7.5 4.5h9A1.5 1.5 0 0118 6v12a1.5 1.5 0 01-1.5 1.5h-9A1.5 1.5 0 016 18V6a1.5 1.5 0 011.5-1.5z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200">No requirements yet</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            Start by adding the first training requirement for this course.
                                        </p>
                                        <button
                                            wire:click="addRequirement"
                                            class="mt-4 inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-indigo-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            Add First Requirement
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Footer --}}
                <div class="flex flex-col gap-3 border-t border-gray-100 bg-gray-50/60 px-5 py-4 dark:border-gray-800 dark:bg-gray-900/60 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Review all entries before saving to avoid incomplete requirement details.
                    </p>

                    <button
                        wire:click="save"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-950">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>