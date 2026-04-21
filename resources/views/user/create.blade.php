<x-layouts.app.flowbite>
     <div class="mx-auto max-w-full">
          <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

               {{-- Header --}}
               <div class="border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-white px-6 py-5 dark:border-gray-800 dark:from-indigo-500/10 dark:to-gray-900">
                    <div class="flex items-start gap-4">
                         <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0ZM4.5 20.118a7.5 7.5 0 0115 0A17.933 17.933 0 0112 21.75a17.933 17.933 0 01-7.5-1.632Z" />
                              </svg>
                         </div>

                         <div>
                              <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                   User Registration
                              </h1>
                              <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                   Fill in the details below to create a new system user account.
                              </p>
                         </div>
                    </div>
               </div>

               <form action="{{ route('users-store.store') }}" method="POST" class="space-y-8">
                    @csrf

                    {{-- Personal Information --}}
                    <div class="px-6 pt-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-indigo-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Personal Information</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Basic identity details of the user</p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                              {{-- First Name --}}
                              <div>
                                   <label for="first_name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        First Name <span class="text-red-500">*</span>
                                   </label>
                                   <input
                                        type="text"
                                        id="first_name"
                                        name="first_name"
                                        value="{{ old('first_name') }}"
                                        placeholder="Enter first name"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10 @error('first_name') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('first_name')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Middle Name --}}
                              <div>
                                   <label for="middle_name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Middle Name
                                   </label>
                                   <input
                                        type="text"
                                        id="middle_name"
                                        name="middle_name"
                                        value="{{ old('middle_name') }}"
                                        placeholder="Enter middle name"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10 @error('middle_name') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('middle_name')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Last Name --}}
                              <div>
                                   <label for="last_name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Last Name <span class="text-red-500">*</span>
                                   </label>
                                   <input
                                        type="text"
                                        id="last_name"
                                        name="last_name"
                                        value="{{ old('last_name') }}"
                                        placeholder="Enter last name"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10 @error('last_name') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('last_name')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Account Information --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-emerald-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Account Information</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Login credentials and account access details</p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              {{-- Email --}}
                              <div class="md:col-span-2">
                                   <label for="email" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Email Address <span class="text-red-500">*</span>
                                   </label>
                                   <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="name@company.com"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10 @error('email') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('email')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Password --}}
                              <div>
                                   <label for="password" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Password <span class="text-red-500">*</span>
                                   </label>
                                   <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        placeholder="••••••••"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10 @error('password') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                   @error('password')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Confirm Password --}}
                              <div>
                                   <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Confirm Password <span class="text-red-500">*</span>
                                   </label>
                                   <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        placeholder="••••••••"
                                        class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10">
                              </div>
                         </div>
                    </div>

                    {{-- Assignment Information --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-violet-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Assignment Information</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Assign role and center affiliation</p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              {{-- Role --}}
                              <div>
                                   <label for="role" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Role <span class="text-red-500">*</span>
                                   </label>
                                   <select
                                        id="role"
                                        name="role"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10 @error('role') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                        <option value="">Choose role</option>
                                        @foreach ($rolelists as $role)
                                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                             {{ $role->name }}
                                        </option>
                                        @endforeach
                                   </select>
                                   @error('role')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>

                              {{-- Center --}}
                              <div>
                                   <label for="center_id" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Center <span class="text-red-500">*</span>
                                   </label>
                                   <select
                                        id="center_id"
                                        name="center_id"
                                        class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-500 dark:focus:ring-indigo-500/10 @error('center_id') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                        <option value="">Select a center</option>
                                        @foreach($centers as $center)
                                        <option value="{{ $center->id }}" {{ old('center_id') == $center->id ? 'selected' : '' }}>
                                             {{ $center->code }} - {{ $center->name }}
                                        </option>
                                        @endforeach
                                   </select>
                                   @error('center_id')
                                   <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                   @enderror
                              </div>
                         </div>
                    </div>

                    {{-- Footer --}}
                    <div class="flex flex-col gap-3 border-t border-gray-100 bg-gray-50 px-6 py-5 dark:border-gray-800 dark:bg-gray-900/70 sm:flex-row sm:items-center sm:justify-between">
                         <p class="text-xs text-gray-500 dark:text-gray-400">
                              Required fields are marked with <span class="text-red-500">*</span>.
                         </p>

                         <div class="flex items-center gap-3">
                              <a
                                   href="{{ route('users.index') }}"
                                   class="inline-flex items-center rounded-2xl border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                                   Cancel
                              </a>

                              <button
                                   type="submit"
                                   class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                   </svg>
                                   Register User
                              </button>
                         </div>
                    </div>
               </form>
          </div>
     </div>
</x-layouts.app.flowbite>