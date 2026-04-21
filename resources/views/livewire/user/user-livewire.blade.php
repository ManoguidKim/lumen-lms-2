<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div class="flex items-start gap-4">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 shadow-sm">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0ZM4.5 20.118a7.5 7.5 0 0115 0A17.933 17.933 0 0112 21.75a17.933 17.933 0 01-7.5-1.632Z" />
                </svg>
            </div>

            <div>
                <h1 class="text-xl font-semibold tracking-tight text-gray-900">Users</h1>
                <p class="mt-1 text-sm text-gray-500">Manage and monitor all system users</p>
            </div>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            {{-- Search --}}
            <div class="relative">
                <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 11 5 11a6 6 0 0112 0z" />
                </svg>
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Search user..."
                    class="w-full rounded-2xl border border-gray-200 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 sm:w-72">
            </div>

            {{-- Create --}}
            <a
                href="{{ route('users-create.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                New User
            </a>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-100 px-5 py-4">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-gray-800">User Directory</h2>
                    <p class="mt-1 text-xs text-gray-500">View user details, email, assigned roles, and edit records.</p>
                </div>
                <div class="text-xs text-gray-400">
                    @if(method_exists($users, 'total'))
                    Total: {{ $users->total() }} user(s)
                    @endif
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-sm">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500 w-14">#</th>
                        <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500">User</th>
                        <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500">Email</th>
                        <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-gray-500">Roles</th>
                        <th class="px-5 py-3 text-right text-[11px] font-semibold uppercase tracking-wider text-gray-500 w-24">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($users as $user)
                    <tr class="transition hover:bg-gray-50/80">
                        <td class="px-5 py-4">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100 text-xs font-semibold text-gray-600">
                                {{ $loop->iteration }}
                            </div>
                        </td>

                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-50 text-sm font-semibold text-indigo-600">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="truncate font-semibold text-gray-900">{{ $user->name }}</p>
                                    <p class="mt-0.5 text-xs text-gray-400">ID: {{ $user->id }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-5 py-4 text-gray-600">
                            <span class="text-sm">{{ $user->email }}</span>
                        </td>

                        <td class="px-5 py-4">
                            <div class="flex flex-wrap gap-1.5">
                                @forelse ($user->roles as $role)
                                <span class="inline-flex items-center rounded-full border border-indigo-100 bg-indigo-50 px-2.5 py-1 text-xs font-medium text-indigo-700">
                                    {{ $role->name }}
                                </span>
                                @empty
                                <span class="inline-flex items-center rounded-full border border-gray-200 bg-gray-50 px-2.5 py-1 text-xs font-medium text-gray-500">
                                    No role
                                </span>
                                @endforelse
                            </div>
                        </td>

                        <td class="px-5 py-4 text-right">
                            <a
                                href="{{ route('users-edit.edit', $user->id) }}"
                                class="inline-flex items-center gap-1.5 rounded-xl border border-indigo-200 bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700 transition hover:bg-indigo-100">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                                </svg>
                                Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-16 text-center">
                            <div class="mx-auto flex max-w-sm flex-col items-center">
                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-gray-400">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0ZM4.5 20.118a7.5 7.5 0 0115 0A17.933 17.933 0 0112 21.75a17.933 17.933 0 01-7.5-1.632Z" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-semibold text-gray-700">No users found</h3>
                                <p class="mt-1 text-sm text-gray-500">Try adjusting your search or create a new user.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION --}}
    @if ($users->hasPages())
    <div class="rounded-2xl border border-gray-200 bg-white px-4 py-3 shadow-sm">
        {{ $users->links() }}
    </div>
    @endif
</div>