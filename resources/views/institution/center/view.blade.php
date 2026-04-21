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
                                   Training Center Update
                              </h1>
                              <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                   Update the details of the training center.
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

               <form id="update-center-form" action="{{ route('centers.update', $center->uuid) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

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
                                        value="{{ old('name', $center->name) }}"
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
                                        value="{{ old('short_name', $center->short_name) }}"
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
                                        value="{{ old('code', $center->code) }}"
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
                                        <option value="both" {{ old('type', $center->type) == 'both' ? 'selected' : '' }}>Assessment & Training</option>
                                        <option value="assessment_center" {{ old('type', $center->type) == 'assessment_center' ? 'selected' : '' }}>Assessment Center</option>
                                        <option value="training_center" {{ old('type', $center->type) == 'training_center' ? 'selected' : '' }}>Training Center</option>
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
                                        <option value="active" {{ old('status', $center->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $center->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                                   class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-emerald-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100 dark:bg-gray-800 dark:text-white dark:focus:border-emerald-500 dark:focus:ring-emerald-500/10 @error('address') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">{{ old('address', $center->address) }}</textarea>
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
                                        value="{{ old('contact_mobile', $center->contact_mobile) }}"
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
                                        value="{{ old('contact_landline', $center->contact_landline) }}"
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
                                        value="{{ old('email', $center->email) }}"
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
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Current logo preview and upload replacement</p>
                              </div>
                         </div>

                         @if($center->logo_path)
                         <div class="mb-5">
                              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                   Current Logo
                              </label>
                              <img
                                   src="{{ asset('storage/' . $center->logo_path) }}"
                                   alt="Center Logo"
                                   class="h-24 w-24 rounded-2xl border border-gray-200 bg-white p-2 object-contain shadow-sm dark:border-gray-700 dark:bg-gray-800">
                         </div>
                         @endif

                         <div class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800/60">
                              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300" for="logo">
                                   Upload New Logo
                              </label>
                              <input
                                   id="logo"
                                   name="logo_path"
                                   type="file"
                                   accept="image/*"
                                   class="block w-full rounded-xl border bg-white px-4 py-3 text-sm text-gray-900 shadow-sm file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-blue-700 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white @error('logo_path') border-red-500 @else border-gray-200 @enderror">
                              <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                   PNG, JPG or JPEG only. Maximum file size: 2MB.
                              </p>
                              @error('logo_path')
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
                                   Delete Center
                              </button>

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
                                   Update Center
                              </button>
                         </div>
                    </div>
               </form>

               <form id="delete-center-form" action="{{ route('centers.destroy', $center->uuid) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
               </form>
          </div>
     </div>

     <script>
          function confirmDelete() {
               if (confirm('Are you sure you want to delete this training center? This action cannot be undone.')) {
                    document.getElementById('delete-center-form').submit();
               }
          }
     </script>
</x-layouts.app.flowbite>