<x-layouts.app.flowbite>

     <div class="max-w-full mx-auto">
          <div class="bg-white rounded-lg shadow-md p-6 md:p-8">
               <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Course Registration</h1>
                    <p class="text-gray-600 mt-1">Fill in the details to register a new course</p>
               </div>

               <form action="{{ route('training_courses.store') }}" method="POST">

                    @csrf

                    {{-- Basic Information --}}
                    <div class="mb-6">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                              {{-- Course Code --}}
                              <div>
                                   <label for="course_code" class="block mb-2 text-sm font-medium text-gray-900">
                                        Course Code <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="text"
                                        id="course_code"
                                        name="course_code"
                                        value="{{ old('course_code') }}"
                                        class="bg-gray-50 border @error('course_code') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter course code">
                                   @error('course_code')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Status --}}
                              <div>
                                   <label for="status" class="block mb-2 text-sm font-medium text-gray-900">
                                        Status
                                   </label>
                                   <select
                                        id="status"
                                        name="status"
                                        class="bg-gray-50 border @error('status') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="Active" {{ old('status', 'Active') == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                   </select>
                                   @error('status')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Course Name --}}
                              <div class="md:col-span-2">
                                   <label for="course_name" class="block mb-2 text-sm font-medium text-gray-900">
                                        Course Name <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="text"
                                        id="course_name"
                                        name="course_name"
                                        value="{{ old('course_name') }}"
                                        class="bg-gray-50 border @error('course_name') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter course name">
                                   @error('course_name')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Description --}}
                              <div class="md:col-span-2">
                                   <label for="description" class="block mb-2 text-sm font-medium text-gray-900">
                                        Description
                                   </label>
                                   <textarea
                                        id="description"
                                        name="description"
                                        rows="4"
                                        class="bg-gray-50 border @error('description') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter course description">{{ old('description') }}</textarea>
                                   @error('description')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Duration Hours --}}
                              <div>
                                   <label for="duration_hours" class="block mb-2 text-sm font-medium text-gray-900">
                                        Duration (Hours)
                                   </label>
                                   <input
                                        type="number"
                                        id="duration_hours"
                                        name="duration_hours"
                                        value="{{ old('duration_hours', 0) }}"
                                        min="0"
                                        class="bg-gray-50 border @error('duration_hours') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter duration in hours">
                                   @error('duration_hours')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- TESDA Information --}}
                    <div class="mb-6">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">TESDA Information</h2>
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                              {{-- Is TESDA Course --}}
                              <div class="md:col-span-2">
                                   <div class="flex items-center">
                                        <input
                                             id="is_tesda_course"
                                             name="is_tesda_course"
                                             type="checkbox"
                                             value="1"
                                             {{ old('is_tesda_course') ? 'checked' : '' }}
                                             class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                        <label for="is_tesda_course" class="ml-2 text-sm font-medium text-gray-900">
                                             This is a TESDA accredited course
                                        </label>
                                   </div>
                                   @error('is_tesda_course')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- TR Number --}}
                              <div class="md:col-span-2" id="tr_number_container">
                                   <label for="tr_number" class="block mb-2 text-sm font-medium text-gray-900">
                                        Training Regulation Number (TR Number)
                                        <span class="text-red-600" id="tr_required_indicator" style="display: none;">*</span>
                                   </label>
                                   <input
                                        type="text"
                                        id="tr_number"
                                        name="tr_number"
                                        value="{{ old('tr_number') }}"
                                        class="bg-gray-50 border @error('tr_number') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter TR number">
                                   <p class="mt-1 text-sm text-gray-500">Required only if this is a TESDA course</p>
                                   @error('tr_number')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                         <button
                              type="submit"
                              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                              Register Course
                         </button>
                         <a
                              href="{{ route('training_courses.index') }}"
                              class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                              Cancel
                         </a>
                    </div>
               </form>
          </div>
     </div>

     {{-- JavaScript for dynamic form behavior --}}
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