<x-layouts.app.flowbite>
     <div class="mx-auto max-w-full">
          <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

               {{-- Header --}}
               <div class="border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white px-6 py-5 dark:border-gray-800 dark:from-blue-500/10 dark:to-gray-900">
                    <div class="flex items-start gap-4">
                         <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                              </svg>
                         </div>

                         <div>
                              <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                   Change Password
                              </h1>
                              <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                   Update your account password to keep your account secure.
                              </p>
                         </div>
                    </div>
               </div>

               {{-- Alerts --}}
               @if(session()->has('success'))
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

               @if(session()->has('error'))
               <div class="mx-6 mt-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-800 shadow-sm dark:border-red-900/40 dark:bg-red-500/10 dark:text-red-300">
                    <div class="flex items-start gap-3">
                         <div class="mt-0.5 flex h-9 w-9 items-center justify-center rounded-xl bg-red-100 dark:bg-red-500/10">
                              <svg class="h-4 w-4 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                   <path fill-rule="evenodd" d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-7-4a1 1 0 10-2 0v4a1 1 0 102 0V6zm-1 8a1.25 1.25 0 100-2.5A1.25 1.25 0 0010 14z" clip-rule="evenodd" />
                              </svg>
                         </div>
                         <div>
                              <p class="text-sm font-semibold">Error</p>
                              <p class="text-sm">{{ session('error') }}</p>
                         </div>
                    </div>
               </div>
               @endif

               @if(session('status') === 'password-updated')
               <div class="mx-6 mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 shadow-sm dark:border-emerald-900/40 dark:bg-emerald-500/10 dark:text-emerald-300">
                    Password updated successfully.
               </div>
               @endif

               <form action="{{ route('users-update-password.update') }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    {{-- Password Information --}}
                    <div class="px-6 pt-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-blue-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">
                                        Password Information
                                   </h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Enter your current password and set a new secure password.
                                   </p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 lg:grid-cols-[1.2fr_0.8fr]">
                              {{-- Form fields --}}
                              <div class="space-y-5">
                                   <div>
                                        <label for="current_password" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                             Current Password <span class="text-red-500">*</span>
                                        </label>
                                        <input
                                             type="password"
                                             id="current_password"
                                             name="current_password"
                                             autocomplete="current-password"
                                             placeholder="Enter your current password"
                                             class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('current_password') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                        @error('current_password')
                                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                        @enderror
                                   </div>

                                   <div>
                                        <label for="password" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                             New Password <span class="text-red-500">*</span>
                                        </label>
                                        <input
                                             type="password"
                                             id="password"
                                             name="password"
                                             autocomplete="new-password"
                                             placeholder="Enter new password"
                                             class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('password') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror">
                                        @error('password')
                                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                        @enderror
                                   </div>

                                   <div>
                                        <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                             Confirm New Password <span class="text-red-500">*</span>
                                        </label>
                                        <input
                                             type="password"
                                             id="password_confirmation"
                                             name="password_confirmation"
                                             autocomplete="new-password"
                                             placeholder="Re-enter new password"
                                             class="block w-full rounded-2xl border bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500/10 @error('password_confirmation') border-red-500 @else border-gray-200 @enderror">
                                        @error('password_confirmation')
                                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                                        @enderror
                                   </div>
                              </div>

                              {{-- Password requirements --}}
                              <div>
                                   <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800/60">
                                        <div class="flex items-start gap-3">
                                             <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                                                  <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                       <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75" />
                                                       <path stroke-linecap="round" stroke-linejoin="round" d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z" />
                                                  </svg>
                                             </div>
                                             <div>
                                                  <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                                                       Password Requirements
                                                  </h3>
                                                  <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                       Use a strong password that meets the following:
                                                  </p>
                                             </div>
                                        </div>

                                        <ul class="mt-4 space-y-3">
                                             <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                                  <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                                                       <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.2 7.2a1 1 0 01-1.415 0l-3.2-3.2a1 1 0 111.414-1.415l2.493 2.493 6.493-6.493a1 1 0 011.415 0z" clip-rule="evenodd" />
                                                       </svg>
                                                  </span>
                                                  At least 8 characters long
                                             </li>
                                             <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                                  <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                                                       <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.2 7.2a1 1 0 01-1.415 0l-3.2-3.2a1 1 0 111.414-1.415l2.493 2.493 6.493-6.493a1 1 0 011.415 0z" clip-rule="evenodd" />
                                                       </svg>
                                                  </span>
                                                  Contains uppercase and lowercase letters
                                             </li>
                                             <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                                  <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                                                       <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.2 7.2a1 1 0 01-1.415 0l-3.2-3.2a1 1 0 111.414-1.415l2.493 2.493 6.493-6.493a1 1 0 011.415 0z" clip-rule="evenodd" />
                                                       </svg>
                                                  </span>
                                                  Contains at least one number or special character
                                             </li>
                                        </ul>
                                   </div>
                              </div>
                         </div>
                    </div>

                    {{-- Footer --}}
                    <div class="flex flex-col gap-3 border-t border-gray-100 bg-gray-50 px-6 py-5 dark:border-gray-800 dark:bg-gray-900/70 sm:flex-row sm:items-center sm:justify-between">
                         <p class="text-xs text-gray-500 dark:text-gray-400">
                              For security, choose a password you have not used before.
                         </p>

                         <div class="flex items-center gap-3">
                              <a
                                   href="{{ route('users.index') }}"
                                   class="inline-flex items-center rounded-2xl border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                                   Cancel
                              </a>

                              <button
                                   type="submit"
                                   class="inline-flex items-center gap-2 rounded-2xl bg-blue-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                   </svg>
                                   Update Password
                              </button>
                         </div>
                    </div>
               </form>
          </div>
     </div>
</x-layouts.app.flowbite>