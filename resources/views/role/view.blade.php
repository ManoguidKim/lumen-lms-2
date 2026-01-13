<x-layouts.app.flowbite>
     <div class="max-w-full mx-auto">
          <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
               {{-- Header --}}
               <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 bg-blue-50 dark:bg-gray-600">
                    <div>
                         <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                              View Role
                         </h3>
                         <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                              View role details and assigned permissions
                         </p>
                    </div>

                    <div class="flex items-center gap-2">
                         <!-- Delete Button -->
                         <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this role?');">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 inline-flex items-center">
                                   <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                   </svg>
                                   Delete
                              </button>
                         </form>

                    </div>
               </div>

               <form action="{{ route('roles.update', $role->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    {{-- Form Content --}}
                    <div class="p-4 md:p-5 space-y-4">
                         {{-- Name --}}
                         <div>
                              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-50">
                                   Role Name <span class="text-red-600">*</span>
                              </label>
                              <input
                                   type="text"
                                   id="name"
                                   name="roleName"
                                   value="{{ old('roleName', $role->name) }}"
                                   class="bg-gray-50 border @error('roleName') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder:text-gray-600"
                                   placeholder="e.g., Morning Training Session">
                              <p class="mt-1 text-gray-500 dark:text-gray-400 text-sm">Provide a clear role name for easy identification.</p>
                              @error('roleName')
                              <span class="text-red-500 text-xs">{{ $message }}</span>
                              @enderror
                         </div>

                         {{-- Permissions --}}
                         <div>
                              <label class="block text-sm font-medium text-gray-700 dark:text-gray-50 mb-2">
                                   Permissions <span class="text-red-600">*</span>
                              </label>

                              <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                   @foreach ($permissions as $permission)
                                   <div class="flex items-center">
                                        <input
                                             type="checkbox"
                                             name="selectedPermissions[]"
                                             value="{{ $permission->id }}" {{ in_array($permission->id, $currentPermissions) ? 'checked' : '' }}
                                             class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="permission-{{ $permission->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                             {{ $permission->name }}
                                        </label>
                                   </div>
                                   @endforeach
                              </div>

                              @error('selectedPermissions')
                              <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                              @enderror
                         </div>
                    </div>

                    {{-- Footer Actions --}}
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                         <button
                              type="submit"
                              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                              Update Role
                         </button>
                         <a
                              href="{{ route('roles.index') }}"
                              class="py-2.5 px-5 ml-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                              Cancel
                         </a>
                    </div>
               </form>
          </div>
     </div>
</x-layouts.app.flowbite>