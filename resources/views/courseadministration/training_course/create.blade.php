<x-layouts.app.flowbite>
     <div class="mx-auto max-w-full">
          <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

               {{-- Header --}}
               <div class="border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white px-6 py-5 dark:border-gray-800 dark:from-blue-500/10 dark:to-gray-900">
                    <div class="flex items-start gap-4">
                         <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                              </svg>
                         </div>

                         <div>
                              <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                   Course Registration
                              </h1>
                              <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                   Fill in the details to register a new course.
                              </p>
                         </div>
                    </div>
               </div>

               <form action="{{ route('training_courses.store') }}" method="POST" class="space-y-8">
                    @csrf

                    {{-- Basic Information --}}
                    <div class="px-6 pt-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-blue-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Basic Information</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Primary course details and description</p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div>
                                   <label for="course_code" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Course Code <span class="text-red-500">*</span>
                                   </label>
                                   <input
                                        type="text"
                                        id="course_code"
                                        name="course_code"
                                        value="{{ old('course_code') }}"
                                        placeholder="Enter course code"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('course_code') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('course_code')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              <div>
                                   <label for="status" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Status
                                   </label>
                                   <select
                                        id="status"
                                        name="status"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('status') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                        <option value="Active" {{ old('status', 'Active') == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                   </select>
                                   @error('status')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              <div class="md:col-span-2">
                                   <label for="course_name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Course Name <span class="text-red-500">*</span>
                                   </label>
                                   <input
                                        type="text"
                                        id="course_name"
                                        name="course_name"
                                        value="{{ old('course_name') }}"
                                        placeholder="Enter course name"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('course_name') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('course_name')
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
                                        rows="4"
                                        placeholder="Enter course description"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('description') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">{{ old('description') }}</textarea>
                                   @error('description')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              <div>
                                   <label for="duration_hours" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Duration (Hours)
                                   </label>
                                   <input
                                        type="number"
                                        id="duration_hours"
                                        name="duration_hours"
                                        value="{{ old('duration_hours', 0) }}"
                                        min="0"
                                        placeholder="Enter duration in hours"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('duration_hours') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('duration_hours')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- TESDA Information --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-emerald-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">TESDA Information</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Course accreditation and regulation details</p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div class="md:col-span-2 rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/60">
                                   <div class="flex items-center">
                                        <input type="hidden" name="is_tesda_course" value="0">
                                        <input
                                             id="is_tesda_course"
                                             name="is_tesda_course"
                                             type="checkbox"
                                             value="1"
                                             {{ old('is_tesda_course', '0') == '1' ? 'checked' : '' }}
                                             class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <label for="is_tesda_course" class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                             This is a TESDA accredited course
                                        </label>
                                   </div>
                                   @error('is_tesda_course')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              <div class="md:col-span-2" id="tr_number_container">
                                   <label for="tr_number" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Training Regulation Number (TR Number)
                                        <span class="text-red-500" id="tr_required_indicator" style="display: none;">*</span>
                                   </label>

                                   <input
                                        type="text"
                                        id="tr_number"
                                        name="tr_number"
                                        value="{{ old('tr_number') }}"
                                        placeholder="Enter TR number"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-emerald-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100 dark:bg-gray-800 dark:text-white dark:focus:border-emerald-500 dark:focus:ring-emerald-500/10 @error('tr_number') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                        Required only if this is a TESDA course.
                                   </p>
                                   @error('tr_number')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Center Assignment --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-violet-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Center Assignment</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Assign this course to one or more training centers</p>
                              </div>
                         </div>

                         <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800/60">
                              <label for="course_center_id" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                   Select Center <span class="text-red-500">*</span>
                              </label>
                              <select
                                   id="course_center_id"
                                   name="course_center_id[]"
                                   multiple
                                   class="block w-full rounded-2xl border bg-white px-4 py-3 text-sm text-gray-900 shadow-sm transition focus:border-violet-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-violet-100 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:focus:border-violet-500 dark:focus:ring-violet-500/10 @error('course_center_id') border-red-500 @else border-gray-200 @enderror">
                                   @foreach($courseCenters as $center)
                                   <option value="{{ $center->id }}" {{ in_array($center->id, old('course_center_id', [])) ? 'selected' : '' }}>
                                        {{ $center->name }}
                                   </option>
                                   @endforeach
                              </select>
                              <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                   Hold Ctrl (Windows) or Command (Mac) to select multiple centers.
                              </p>
                              @error('course_center_id')
                              <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                              @enderror
                         </div>
                    </div>

                    {{-- Footer --}}
                    <div class="flex flex-col gap-3 border-t border-gray-100 bg-gray-50 px-6 py-5 dark:border-gray-800 dark:bg-gray-900/70 sm:flex-row sm:items-center sm:justify-between">
                         <p class="text-xs text-gray-500 dark:text-gray-400">
                              Review the course details carefully before saving.
                         </p>

                         <div class="flex items-center gap-3">
                              <a
                                   href="{{ route('training_courses.index') }}"
                                   class="inline-flex items-center rounded-2xl border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                                   Cancel
                              </a>

                              <button
                                   type="submit"
                                   class="inline-flex items-center gap-2 rounded-2xl bg-blue-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                   </svg>
                                   Register Course
                              </button>
                         </div>
                    </div>
               </form>
          </div>
     </div>

     <script>
          document.addEventListener('DOMContentLoaded', function() {
               const tesdaCheckbox = document.getElementById('is_tesda_course');
               const trNumberInput = document.getElementById('tr_number');
               const trRequiredIndicator = document.getElementById('tr_required_indicator');

               function toggleTRNumber() {
                    if (tesdaCheckbox.checked) {
                         trRequiredIndicator.style.display = 'inline';
                         trNumberInput.parentElement.classList.add('opacity-100');
                    } else {
                         trRequiredIndicator.style.display = 'none';
                         trNumberInput.parentElement.classList.remove('opacity-100');
                    }
               }

               tesdaCheckbox.addEventListener('change', toggleTRNumber);
               toggleTRNumber();
          });
     </script>
</x-layouts.app.flowbite>