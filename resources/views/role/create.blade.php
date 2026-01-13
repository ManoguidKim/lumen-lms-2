<x-layouts.app.flowbite>
     <div class="max-w-full mx-auto">
          <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
               {{-- Header --}}
               <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 bg-blue-50 dark:bg-gray-600">
                    <div>
                         <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                              Create Role
                         </h3>
                         <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                              Create a new role with specific permissions
                         </p>
                    </div>
               </div>

               <form action="{{ route('roles.store') }}" method="POST">
                    @csrf

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
                                   value="{{ old('roleName') }}"
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
                                             value="{{ $permission->id }}"
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
                              Save Role
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