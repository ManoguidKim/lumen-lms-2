<x-layouts.app.flowbite>

     <div class="max-w-full mx-auto">
          <div class="bg-white rounded-lg shadow-md p-6 md:p-8">
               <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Training Center Registration</h1>
                    <p class="text-gray-600 mt-1">Fill in the details to register a new training center</p>
               </div>

               <form action="{{ route('centers.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    {{-- Basic Information --}}
                    <div class="mb-6">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                              {{-- Center Name --}}
                              <div class="md:col-span-2">
                                   <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                                        Center Name <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                        class="bg-gray-50 border @error('name') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter center name">
                                   @error('name')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Short Name --}}
                              <div>
                                   <label for="short_name" class="block mb-2 text-sm font-medium text-gray-900">
                                        Short Name
                                   </label>
                                   <input
                                        type="text"
                                        id="short_name"
                                        name="short_name"
                                        value="{{ old('short_name') }}"
                                        class="bg-gray-50 border @error('short_name') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter short name">
                                   @error('short_name')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Center Code --}}
                              <div>
                                   <label for="code" class="block mb-2 text-sm font-medium text-gray-900">
                                        Center Code
                                   </label>
                                   <input
                                        type="text"
                                        id="code"
                                        name="code"
                                        value="{{ old('code') }}"
                                        class="bg-gray-50 border @error('code') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter center code">
                                   @error('code')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Center Type --}}
                              <div>
                                   <label for="type" class="block mb-2 text-sm font-medium text-gray-900">
                                        Center Type <span class="text-red-600">*</span>
                                   </label>
                                   <select
                                        id="type"
                                        name="type"
                                        class="bg-gray-50 border @error('type') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="">Select center type</option>
                                        <option value="both" {{ old('type', 'both') == 'both' ? 'selected' : '' }}>Assessment & Training</option>
                                        <option value="assessment_center" {{ old('type') == 'assessment_center' ? 'selected' : '' }}>Assessment Center</option>
                                        <option value="training_center" {{ old('type') == 'training_center' ? 'selected' : '' }}>Training Center</option>
                                   </select>
                                   @error('type')
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
                                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                   </select>
                                   @error('status')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Location --}}
                    <div class="mb-6">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Location</h2>
                         <div>
                              <label for="address" class="block mb-2 text-sm font-medium text-gray-900">
                                   Complete Address
                              </label>
                              <textarea
                                   id="address"
                                   name="address"
                                   rows="3"
                                   class="bg-gray-50 border @error('address') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   placeholder="Enter complete address">{{ old('address') }}</textarea>
                              @error('address')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                         </div>
                    </div>

                    {{-- Contact Information --}}
                    <div class="mb-6">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h2>
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                              {{-- Mobile Number --}}
                              <div>
                                   <label for="contact_mobile" class="block mb-2 text-sm font-medium text-gray-900">
                                        Mobile Number
                                   </label>
                                   <input
                                        type="text"
                                        id="contact_mobile"
                                        name="contact_mobile"
                                        value="{{ old('contact_mobile') }}"
                                        class="bg-gray-50 border @error('contact_mobile') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="+63 9XX XXX XXXX">
                                   @error('contact_mobile')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Landline Number --}}
                              <div>
                                   <label for="contact_landline" class="block mb-2 text-sm font-medium text-gray-900">
                                        Landline Number
                                   </label>
                                   <input
                                        type="text"
                                        id="contact_landline"
                                        name="contact_landline"
                                        value="{{ old('contact_landline') }}"
                                        class="bg-gray-50 border @error('contact_landline') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="(02) XXXX XXXX">
                                   @error('contact_landline')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Email --}}
                              <div>
                                   <label for="email" class="block mb-2 text-sm font-medium text-gray-900">
                                        Email Address
                                   </label>
                                   <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        class="bg-gray-50 border @error('email') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="center@example.com">
                                   @error('email')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Logo --}}
                    <div class="mb-6">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Logo</h2>
                         <div>
                              <label class="block mb-2 text-sm font-medium text-gray-900" for="logo">
                                   Upload Logo
                              </label>
                              <input
                                   class="block w-full text-sm text-gray-900 border @error('logo') border-red-500 @else border-gray-300 @enderror rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                   id="logo"
                                   name="logo_path"
                                   type="file"
                                   accept="image/*">
                              <p class="mt-1 text-sm text-gray-500">PNG, JPG or JPEG (MAX. 2MB)</p>
                              @error('logo_path')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                         </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                         <button
                              type="submit"
                              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                              Register Center
                         </button>
                         <a
                              href="{{ route('centers.index') }}"
                              class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                              Cancel
                         </a>
                    </div>
               </form>
          </div>
     </div>
</x-layouts.app.flowbite>