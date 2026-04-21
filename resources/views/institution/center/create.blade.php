<x-layouts.app.flowbite>
     <div class="mx-auto max-w-full">
          <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

               {{-- Header --}}
               <div class="border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white px-6 py-5 dark:border-gray-800 dark:from-blue-500/10 dark:to-gray-900">
                    <div class="flex items-start gap-4">
                         <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 21V7.5l8.25-4.5L21 7.5V21M9 21V12h7.5v9" />
                              </svg>
                         </div>

                         <div>
                              <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                   Training Center Registration
                              </h1>
                              <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                   Fill in the details to register a new training center.
                              </p>
                         </div>
                    </div>
               </div>

               <form action="{{ route('centers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    {{-- Basic Information --}}
                    <div class="px-6 pt-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-blue-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Basic Information</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Primary center details and identification</p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div class="md:col-span-2">
                                   <label for="name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Center Name <span class="text-red-500">*</span>
                                   </label>
                                   <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Enter center name"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('name') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('name')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              <div>
                                   <label for="short_name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Short Name
                                   </label>
                                   <input
                                        type="text"
                                        id="short_name"
                                        name="short_name"
                                        value="{{ old('short_name') }}"
                                        placeholder="Enter short name"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('short_name') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('short_name')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              <div>
                                   <label for="code" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Center Code
                                   </label>
                                   <input
                                        type="text"
                                        id="code"
                                        name="code"
                                        value="{{ old('code') }}"
                                        placeholder="Enter center code"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('code') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('code')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              <div>
                                   <label for="type" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Center Type <span class="text-red-500">*</span>
                                   </label>
                                   <select
                                        id="type"
                                        name="type"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('type') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                        <option value="">Select center type</option>
                                        <option value="both" {{ old('type', 'both') == 'both' ? 'selected' : '' }}>Assessment & Training</option>
                                        <option value="assessment_center" {{ old('type') == 'assessment_center' ? 'selected' : '' }}>Assessment Center</option>
                                        <option value="training_center" {{ old('type') == 'training_center' ? 'selected' : '' }}>Training Center</option>
                                   </select>
                                   @error('type')
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
                                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                   </select>
                                   @error('status')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Location --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-emerald-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Location</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Physical address and site location</p>
                              </div>
                         </div>

                         <div>
                              <label for="address" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                   Complete Address
                              </label>
                              <textarea
                                   id="address"
                                   name="address"
                                   rows="4"
                                   placeholder="Enter complete address"
                                   class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-emerald-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100 dark:bg-gray-800 dark:text-white dark:focus:border-emerald-500 dark:focus:ring-emerald-500/10 @error('address') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">{{ old('address') }}</textarea>
                              @error('address')
                              <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                              @enderror
                         </div>
                    </div>

                    {{-- Contact Information --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-violet-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Contact Information</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Phone numbers and email details</p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div>
                                   <label for="contact_mobile" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Mobile Number
                                   </label>
                                   <input
                                        type="text"
                                        id="contact_mobile"
                                        name="contact_mobile"
                                        value="{{ old('contact_mobile') }}"
                                        placeholder="+63 9XX XXX XXXX"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-violet-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-violet-100 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:ring-violet-500/10 @error('contact_mobile') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('contact_mobile')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              <div>
                                   <label for="contact_landline" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Landline Number
                                   </label>
                                   <input
                                        type="text"
                                        id="contact_landline"
                                        name="contact_landline"
                                        value="{{ old('contact_landline') }}"
                                        placeholder="(02) XXXX XXXX"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-violet-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-violet-100 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:ring-violet-500/10 @error('contact_landline') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('contact_landline')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              <div class="md:col-span-2">
                                   <label for="email" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Email Address
                                   </label>
                                   <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="center@example.com"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-violet-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-violet-100 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:ring-violet-500/10 @error('email') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('email')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Logo --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-amber-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Logo</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Upload the official training center logo</p>
                              </div>
                         </div>

                         <div class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800/60">
                              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300" for="logo">
                                   Upload Logo
                              </label>
                              <input
                                   class="block w-full rounded-xl border bg-white px-4 py-3 text-sm text-gray-900 shadow-sm file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-blue-700 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white @error('logo_path') border-red-500 @else border-gray-200 @enderror"
                                   id="logo"
                                   name="logo_path"
                                   type="file"
                                   accept="image/*">
                              <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                   PNG, JPG, or JPEG only. Maximum file size: 2MB.
                              </p>
                              @error('logo_path')
                              <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                              @enderror
                         </div>
                    </div>

                    {{-- Footer --}}
                    <div class="flex flex-col gap-3 border-t border-gray-100 bg-gray-50 px-6 py-5 dark:border-gray-800 dark:bg-gray-900/70 sm:flex-row sm:items-center sm:justify-between">
                         <p class="text-xs text-gray-500 dark:text-gray-400">
                              Required fields are marked with <span class="text-red-500">*</span>.
                         </p>

                         <div class="flex items-center gap-3">
                              <a
                                   href="{{ route('centers.index') }}"
                                   class="inline-flex items-center rounded-2xl border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                                   Cancel
                              </a>

                              <button
                                   type="submit"
                                   class="inline-flex items-center gap-2 rounded-2xl bg-blue-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 21V7.5l8.25-4.5L21 7.5V21M9 21V12h7.5v9" />
                                   </svg>
                                   Register Center
                              </button>
                         </div>
                    </div>
               </form>
          </div>
     </div>
</x-layouts.app.flowbite>