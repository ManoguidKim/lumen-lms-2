<x-layouts.app.flowbite>
     <div class="mx-auto max-w-full">
          <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

               {{-- Header --}}
               <div class="border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white px-6 py-5 dark:border-gray-800 dark:from-blue-500/10 dark:to-gray-900">
                    <div class="flex items-start gap-4">
                         <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                              </svg>
                         </div>

                         <div>
                              <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                   Training Schedule Item Update
                              </h1>
                              <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                   Update the details of the training schedule item
                              </p>
                         </div>
                    </div>
               </div>

               {{-- Success Message --}}
               @if(session('success'))
               <div class="mx-6 mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 shadow-sm dark:border-emerald-900/40 dark:bg-emerald-500/10 dark:text-emerald-300">
                    <div class="flex items-start gap-3">
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
               </div>
               @endif

               <form id="update-schedule-item-form" action="{{ route('training_schedule_items.update', $trainingScheduleItem->uuid) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    {{-- Basic Information --}}
                    <div class="px-6 pt-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-blue-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Basic Information</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Schedule name and description details</p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div class="md:col-span-2">
                                   <label for="name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Schedule Name <span class="text-red-500">*</span>
                                   </label>
                                   <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $trainingScheduleItem->name) }}"
                                        placeholder="e.g. Morning Training Session"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('name') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('name')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              <div class="md:col-span-2">
                                   <label for="description" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Description
                                   </label>
                                   <textarea
                                        id="description"
                                        name="description"
                                        rows="3"
                                        placeholder="Optional description"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('description') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">{{ old('description', $trainingScheduleItem->description) }}</textarea>
                                   @error('description')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Schedule Days --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-emerald-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Schedule Days</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Choose the active days for this schedule</p>
                              </div>
                         </div>

                         @php
                         $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                         $oldDays = old('schedule_days', $trainingScheduleItem->schedule_days ?? []);
                         @endphp

                         <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800/60">
                              <div class="grid grid-cols-2 gap-3 md:grid-cols-4">
                                   @foreach ($days as $day)
                                   <label class="flex items-center gap-3 rounded-xl border border-gray-200 bg-white px-4 py-3 transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:hover:bg-gray-800">
                                        <input
                                             type="checkbox"
                                             name="schedule_days[]"
                                             value="{{ $day }}"
                                             {{ in_array($day, $oldDays) ? 'checked' : '' }}
                                             class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $day }}</span>
                                   </label>
                                   @endforeach
                              </div>

                              @error('schedule_days')
                              <p class="mt-3 text-xs font-medium text-red-600">{{ $message }}</p>
                              @enderror
                         </div>
                    </div>

                    {{-- Session Time --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-violet-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Session Time</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Set the start and end time of the session</p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div>
                                   <label for="start_time" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Start Time <span class="text-red-500">*</span>
                                   </label>
                                   <input
                                        type="time"
                                        id="start_time"
                                        name="start_time"
                                        value="{{ old('start_time', date('H:i', strtotime($trainingScheduleItem->start_time))) }}"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition focus:border-violet-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-violet-100 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:ring-violet-500/10 @error('start_time') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('start_time')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              <div>
                                   <label for="end_time" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        End Time <span class="text-red-500">*</span>
                                   </label>
                                   <input
                                        type="time"
                                        id="end_time"
                                        name="end_time"
                                        value="{{ old('end_time', date('H:i', strtotime($trainingScheduleItem->end_time))) }}"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition focus:border-violet-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-violet-100 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:ring-violet-500/10 @error('end_time') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('end_time')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Footer --}}
                    <div class="flex flex-col gap-3 border-t border-gray-100 bg-gray-50 px-6 py-5 dark:border-gray-800 dark:bg-gray-900/70 sm:flex-row sm:items-center sm:justify-between">
                         <p class="text-xs text-gray-500 dark:text-gray-400">
                              Review all schedule details carefully before saving changes.
                         </p>

                         <div class="flex items-center gap-3">
                              <button
                                   type="submit"
                                   class="inline-flex items-center gap-2 rounded-2xl bg-blue-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                   </svg>
                                   Update Schedule
                              </button>

                              <button
                                   type="button"
                                   onclick="confirmDelete()"
                                   class="inline-flex items-center gap-2 rounded-2xl bg-red-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                   </svg>
                                   Delete Schedule
                              </button>

                              <a href="{{ route('training_schedule_items.index') }}"
                                   class="inline-flex items-center rounded-2xl border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                                   Cancel
                              </a>
                         </div>
                    </div>
               </form>

               {{-- Hidden Delete Form --}}
               <form id="delete-schedule-item-form" action="{{ route('training_schedule_items.destroy', $trainingScheduleItem->uuid) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
               </form>
          </div>
     </div>

     <script>
          function confirmDelete() {
               if (confirm('Are you sure you want to delete this training schedule item? This action cannot be undone.')) {
                    document.getElementById('delete-schedule-item-form').submit();
               }
          }
     </script>
</x-layouts.app.flowbite>