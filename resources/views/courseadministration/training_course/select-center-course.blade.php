<x-layouts.app.flowbite>

     <div class="max-w-full mx-auto">
          <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
               {{-- Header --}}
               <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 bg-blue-50 dark:bg-gray-600">
                    <div>
                         <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                              Center Course Registration
                         </h3>
                         <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                              Fill in the details to register a new center course
                         </p>
                    </div>
               </div>

               <form action="#" method="POST">

                    @csrf

                    {{-- TESDA Information --}}
                    <div class="p-4 md:p-5 space-y-4">
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
               </form>
          </div>
     </div>
</x-layouts.app.flowbite>