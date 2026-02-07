<div>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Users</h1>
            <p class="text-sm text-gray-400 mt-0.5">Manage and monitor all system users</p>
        </div>
        <div class="flex items-center gap-3">
            <!-- Search -->
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 11 5 11a6 6 0 0112 0z" />
                </svg>
                <input
                    type="text"
                    placeholder="Search user..."
                    wire:model.live="search"
                    class="pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg w-64 bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
            </div>
            <!-- Create Button -->
            <button wire:click="toggleModal()"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 rounded-lg shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                New User
            </button>
        </div>
    </div>

    @if(session()->has('success'))
    <div class="m-4 md:m-5 p-4 text-green-800 bg-green-50 rounded-lg border border-green-200 dark:bg-green-900 dark:text-green-200" role="alert">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session()->has('error'))
    <div class="m-4 md:m-5 p-4 text-red-800 bg-red-50 rounded-lg border border-red-200 dark:bg-red-900 dark:text-red-200" role="alert">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
            {{ session('error') }}
        </div>
    </div>
    @endif

    <!-- Table -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr class="border-b border-gray-100 last:border-0 hover:bg-gray-50 transition">
                        <td class="px-5 py-3.5 text-gray-400 font-medium">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-5 py-3.5 text-gray-800 font-semibold">
                            {{ $user->name }}
                        </td>
                        <td class="px-5 py-3.5 text-gray-600">
                            {{ $user->email }}
                        </td>
                        <td class="px-5 py-3.5 text-gray-600">
                            <div class="flex flex-wrap gap-1.5">
                                @foreach ($user->roles as $roles)
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                    {{ $roles->name }}
                                </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <button class="text-indigo-500 hover:text-indigo-700 font-medium text-sm transition">
                                Edit →
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-4 text-center">
                            <svg class="mx-auto w-10 h-10 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-400">No users found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($users->hasPages())
    <div class="mt-4">
        {{ $users->links() }}
    </div>
    @endif

    <!-- Modal -->
    @if($isOpenModal)
    <div id="static-modal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 flex justify-center items-center bg-black/50">
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 bg-indigo-50">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Create New User
                    </h3>
                    <button wire:click="toggleModal()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <div class="p-4 md:p-5 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" wire:model="userName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 placeholder:text-gray-400" placeholder="Enter user name">
                        <p class="mt-1 text-xs text-gray-500">Provide a clear user name. This will help identify the user in reports and management.</p>
                        @error('userName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="text" wire:model="userEmail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 placeholder:text-gray-400" placeholder="Enter user email">
                        @error('userEmail') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" wire:model="userPassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 placeholder:text-gray-400" placeholder="Enter password">
                        @error('userPassword') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">User Role</label>
                        <select wire:model="userRole" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 placeholder:text-gray-400">
                            <option value="">Choose role</option>
                            @foreach ($rolelists as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('userRole') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Assign Center</label>
                        <select wire:model="userCenter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 placeholder:text-gray-400">
                            <option value="">Choose center</option>
                            @foreach ($centers as $center)
                            <option value="{{ $center->id }}">{{ $center->name }}</option>
                            @endforeach
                        </select>
                        @error('userRole') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                    <button wire:click="saveUser" class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Save
                    </button>
                    <button wire:click="toggleModal()" class="py-2.5 px-5 ml-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-indigo-700">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>