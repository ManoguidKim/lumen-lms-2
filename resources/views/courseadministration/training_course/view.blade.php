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
                                   Course Update
                              </h1>
                              <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                   Update the details of the training course.
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

               <form id="update-course-form" action="{{ route('training_courses.update', $course->uuid) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

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
                                        value="{{ old('course_code', $course->course_code) }}"
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
                                        <option value="Active" {{ old('status', $course->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ old('status', $course->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
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
                                        value="{{ old('course_name', $course->course_name) }}"
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
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('description') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">{{ old('description', $course->description) }}</textarea>
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
                                        value="{{ old('duration_hours', $course->duration_hours) }}"
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
                                             {{ old('is_tesda_course', $course->is_tesda_course) == '1' ? 'checked' : '' }}
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
                                        value="{{ old('tr_number', $course->tr_number) }}"
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
                                   <option value="{{ $center->id }}"
                                        {{ in_array($center->id, old('course_center_id', $selectedCenterIds)) ? 'selected' : '' }}>
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
                              Review all changes carefully before saving.
                         </p>

                         <div class="flex items-center gap-3">
                              <button
                                   type="button"
                                   onclick="confirmDelete()"
                                   class="inline-flex items-center rounded-2xl bg-red-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                                   Delete Course
                              </button>

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
                                   Update Course
                              </button>
                         </div>
                    </div>
               </form>

               {{-- Hidden Delete Form --}}
               <form id="delete-course-form" action="{{ route('training_courses.destroy', $course->uuid) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
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

          function confirmDelete() {
               if (confirm('Are you sure you want to delete this training course? This action cannot be undone.')) {
                    document.getElementById('delete-course-form').submit();
               }
          }
     </script>
</x-layouts.app.flowbite>