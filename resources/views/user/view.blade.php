<x-layouts.app.flowbite>
     <div class="max-w-full mx-auto">
          <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
               {{-- Header --}}
               <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 bg-blue-50 dark:bg-gray-600">
                    <div>
                         <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                              User Update
                         </h3>
                         <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                              Update the details of the user
                         </p>
                    </div>
               </div>

               {{-- Success Message --}}
               @if(session('success'))
               <div class="m-4 md:m-5 p-4 text-green-800 bg-green-50 rounded-lg" role="alert">
                    {{ session('success') }}
               </div>
               @endif

               <form id="update-user-form" action="{{ route('users-update.update', $user->id) }}" method="POST">

                    @csrf
                    @method('PUT')

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
                                        <option value="{{ $role->name }}" {{ old('role', $user->getRoleNames()->first()) == $role->name ? 'selected' : '' }}>
                                             {{ $role->name }}
                                        </option>
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
                                        <option value="{{ $center->id }}" {{ old('center_id', $user->center_id) == $center->id ? 'selected' : '' }}>
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
                              Update User
                         </button>
                         <button
                              type="button"
                              onclick="confirmDelete()"
                              class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 ml-3 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                              Delete User
                         </button>

                         <a href="{{ route('users.index') }}"
                              class="py-2.5 px-5 ml-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                              Cancel
                         </a>
                    </div>

               </form>

               {{-- Hidden Delete Form --}}
               <form id="delete-user-form" action="#" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
               </form>
          </div>
     </div>

     {{-- Delete Confirmation Script --}}
     <script>
          function confirmDelete() {
               if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                    document.getElementById('delete-user-form').submit();
               }
          }
     </script>
</x-layouts.app.flowbite>