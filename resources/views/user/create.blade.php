<x-layouts.app.flowbite>

     <div class="max-w-full mx-auto">
          <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
               {{-- Header --}}
               <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 bg-blue-50 dark:bg-gray-600">
                    <div>
                         <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                              User Registration
                         </h3>
                         <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                              Fill in the details to register a new user
                         </p>
                    </div>
               </div>

               <form action="{{ route('users-store.store') }}" method="POST">

                    @csrf

                    {{-- Personal Information --}}
                    <div class="p-4 md:p-5 space-y-4">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h2>
                         <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                              {{-- First Name --}}
                              <div>
                                   <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">
                                        First Name <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="text"
                                        id="first_name"
                                        name="first_name"
                                        value="{{ old('first_name') }}"
                                        class="bg-gray-50 border @error('first_name') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter first name">
                                   @error('first_name')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Middle Name --}}
                              <div>
                                   <label for="middle_name" class="block mb-2 text-sm font-medium text-gray-900">
                                        Middle Name
                                   </label>
                                   <input
                                        type="text"
                                        id="middle_name"
                                        name="middle_name"
                                        value="{{ old('middle_name') }}"
                                        class="bg-gray-50 border @error('middle_name') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter middle name">
                                   @error('middle_name')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Last Name --}}
                              <div>
                                   <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">
                                        Last Name <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="text"
                                        id="last_name"
                                        name="last_name"
                                        value="{{ old('last_name') }}"
                                        class="bg-gray-50 border @error('last_name') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Enter last name">
                                   @error('last_name')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Account Information --}}
                    <div class="p-4 md:p-5 space-y-4">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Account Information</h2>
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                              {{-- Email --}}
                              <div class="md:col-span-2">
                                   <label for="email" class="block mb-2 text-sm font-medium text-gray-900">
                                        Email Address <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        class="bg-gray-50 border @error('email') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="name@company.com">
                                   @error('email')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Password --}}
                              <div>
                                   <label for="password" class="block mb-2 text-sm font-medium text-gray-900">
                                        Password <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="bg-gray-50 border @error('password') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="••••••••">
                                   @error('password')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Confirm Password --}}
                              <div>
                                   <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">
                                        Confirm Password <span class="text-red-600">*</span>
                                   </label>
                                   <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="••••••••">
                              </div>
                         </div>
                    </div>

                    {{-- Assignment Information --}}
                    <div class="p-4 md:p-5 space-y-4">
                         <h2 class="text-lg font-semibold text-gray-900 mb-4">Assignment Information</h2>
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                              {{-- Role --}}
                              <div>
                                   <label for="role" class="block mb-2 text-sm font-medium text-gray-900">
                                        Role <span class="text-red-600">*</span>
                                   </label>
                                   <select
                                        id="role"
                                        name="role"
                                        class="bg-gray-50 border @error('role') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="">Choose role</option>
                                        @foreach ($rolelists as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                   </select>
                                   @error('role')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Center --}}
                              <div>
                                   <label for="center_id" class="block mb-2 text-sm font-medium text-gray-900">
                                        Center <span class="text-red-600">*</span>
                                   </label>
                                   <select
                                        id="center_id"
                                        name="center_id"
                                        class="bg-gray-50 border @error('center_id') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="">Select a center</option>
                                        @foreach($centers as $center)
                                        <option value="{{ $center->id }}" {{ old('center_id') == $center->id ? 'selected' : '' }}>
                                             {{ $center->code }} - {{ $center->name }}
                                        </option>
                                        @endforeach
                                   </select>
                                   @error('center_id')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                         <button
                              type="submit"
                              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                              Register User
                         </button>

                         <a href="{{ route('users.index') }}"
                              class="py-2.5 px-5 ml-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                              Cancel
                         </a>
                    </div>

               </form>
          </div>
     </div>

</x-layouts.app.flowbite>