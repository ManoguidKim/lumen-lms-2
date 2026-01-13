<x-layouts.app.flowbite>

     <div class="max-w-full mx-auto">
          <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
               {{-- Header --}}
               <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 bg-blue-50 dark:bg-gray-600">
                    <div>
                         <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                              Training Center Update
                         </h3>
                         <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                              Update the details of the training center
                         </p>
                    </div>
               </div>

               {{-- Success Message --}}
               @if(session('success'))
               <div class="m-4 md:m-5 p-4 text-green-800 bg-green-50 rounded-lg" role="alert">
                    {{ session('success') }}
               </div>
               @endif

               <form id="update-center-form" action="{{ route('centers.update', $center->uuid) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Basic Information --}}
                    <div class="p-4 md:p-5 space-y-4">
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
                                        value="{{ old('name', $center->name) }}"
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
                                        value="{{ old('short_name', $center->short_name) }}"
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
                                        value="{{ old('code', $center->code) }}"
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
                                        <option value="both" {{ old('type', $center->type) == 'both' ? 'selected' : '' }}>Assessment & Training</option>
                                        <option value="assessment_center" {{ old('type', $center->type) == 'assessment_center' ? 'selected' : '' }}>Assessment Center</option>
                                        <option value="training_center" {{ old('type', $center->type) == 'training_center' ? 'selected' : '' }}>Training Center</option>
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
                                        <option value="active" {{ old('status', $center->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $center->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                   </select>
                                   @error('status')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Location --}}
                    <div class="p-4 md:p-5 space-y-4">
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
                                   placeholder="Enter complete address">{{ old('address', $center->address) }}</textarea>
                              @error('address')
                              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                         </div>
                    </div>

                    {{-- Contact Information --}}
                    <div class="p-4 md:p-5 space-y-4">
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
                                        value="{{ old('contact_mobile', $center->contact_mobile) }}"
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
                                        value="{{ old('contact_landline', $center->contact_landline) }}"
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
                                        value="{{ old('email', $center->email) }}"
                                        class="bg-gray-50 border @error('email') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="center@example.com">
                                   @error('email')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Logo --}}
                    <div class="p-4 md:p-5 space-y-4">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Logo</h2>

                         {{-- Current Logo Preview --}}
                         @if($center->logo_path)
                         <div class="mb-4">
                              <label class="block mb-2 text-sm font-medium text-gray-900">Current Logo</label>
                              <img src="{{ asset('storage/' . $center->logo_path) }}" alt="Center Logo" class="h-24 w-24 object-contain border border-gray-300 rounded-lg p-2">
                         </div>
                         @endif

                         <div>
                              <label class="block mb-2 text-sm font-medium text-gray-900" for="logo">
                                   Upload New Logo
                              </label>
                              <input
                                   class="block w-full text-sm text-gray-900 border @error('logo_path') border-red-500 @else border-gray-300 @enderror rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
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
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                         <button
                              type="submit"
                              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                              Update Center
                         </button>
                         <button
                              type="button"
                              onclick="confirmDelete()"
                              class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 ml-3 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                              Delete Center
                         </button>
                         <a
                              href="{{ route('centers.index') }}"
                              class="py-2.5 px-5 ml-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                              Cancel
                         </a>
                    </div>

               </form>

               {{-- Hidden Delete Form --}}
               <form id="delete-center-form" action="{{ route('centers.destroy', $center->uuid) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
               </form>
          </div>
     </div>

     {{-- Delete Confirmation Script --}}
     <script>
          function confirmDelete() {
               if (confirm('Are you sure you want to delete this training center? This action cannot be undone.')) {
                    document.getElementById('delete-center-form').submit();
               }
          }
     </script>
</x-layouts.app.flowbite>