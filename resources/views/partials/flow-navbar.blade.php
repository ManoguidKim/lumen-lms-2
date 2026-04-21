<div class="antialiased bg-slate-50 dark:bg-gray-950">

    {{-- ── Navbar ── --}}
    <nav class="fixed top-0 z-50 w-full h-14 bg-gradient-to-r from-indigo-600 via-blue-600 to-indigo-700 border-b border-white/10 shadow-md flex items-center px-4 lg:px-6 justify-between">

        {{-- Left --}}
        <div class="flex items-center gap-3">
            {{-- Mobile toggle --}}
            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                aria-controls="logo-sidebar" type="button"
                class="sm:hidden inline-flex items-center justify-center w-8 h-8 rounded-lg text-white/80 hover:bg-white/10 transition-colors">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z" />
                </svg>
            </button>

            {{-- Brand --}}
            <a href="#" class="flex items-center gap-2.5 group">
                <div class="w-8 h-8 bg-white/15 rounded-lg flex items-center justify-center flex-shrink-0 ring-1 ring-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                        <path d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z" />
                        <path d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 016 13.18v1.27a1.5 1.5 0 00-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.661a6.729 6.729 0 00.551-1.608 1.5 1.5 0 00.14-2.67v-.645a48.549 48.549 0 013.44 1.668 2.25 2.25 0 002.12 0z" />
                    </svg>
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-sm font-semibold text-white tracking-wide">LUMEN</span>
                    <span class="text-xs text-white/70 hidden sm:block">Learning Management System</span>
                </div>
            </a>
        </div>

        {{-- Right --}}
        <div class="flex items-center gap-2">

            {{-- Dark mode toggle --}}
            <button id="theme-toggle" type="button" title="Toggle dark mode"
                class="w-8 h-8 flex items-center justify-center rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-colors">
                <svg id="theme-toggle-light-icon" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd" />
                </svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>

            {{-- Notifications --}}
            <button type="button"
                class="w-8 h-8 flex items-center justify-center rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-colors relative">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
            </button>

            {{-- User dropdown --}}
            <div class="relative" data-dropdown-toggle="dropdown-user">
                @auth
                <button type="button"
                    class="flex items-center gap-2 px-2 py-1 rounded-lg hover:bg-white/10 transition-colors">
                    <div class="relative">
                        <div class="w-7 h-7 rounded-full bg-white/15 ring-1 ring-white/20 flex items-center justify-center text-white text-xs font-semibold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="absolute -bottom-0.5 -right-0.5 block h-2 w-2 rounded-full bg-green-400 ring-1 ring-indigo-700"></span>
                    </div>
                    <div class="hidden sm:flex flex-col items-start leading-none">
                        <span class="text-xs font-medium text-white">{{ Auth::user()->name }}</span>
                        <span class="text-xs text-white/70">{{ auth()->user()->roles->first()->name }}</span>
                    </div>
                    <svg class="w-3.5 h-3.5 text-white/70 hidden sm:block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                @endauth

                <div id="dropdown-user"
                    class="hidden absolute right-0 top-full mt-2 w-56 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg z-50 overflow-hidden">

                    {{-- User header --}}
                    <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-800">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-full bg-indigo-500 flex items-center justify-center text-white text-sm font-semibold flex-shrink-0">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                    {{ Auth::user()->name }} {{ Auth::user()->last_name }}
                                </p>
                                <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="mt-2.5">
                            <span class="inline-flex items-center gap-1 text-xs font-medium px-2 py-0.5 rounded-full bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                {{ auth()->user()->roles->first()->name }}
                            </span>
                        </div>
                    </div>

                    <ul class="py-1">
                        <li>
                            <a href="{{ url('/dashboard') }}"
                                class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75h7.5v7.5h-7.5zM12.75 3.75h7.5v4.5h-7.5zM12.75 12.75h7.5v7.5h-7.5zM3.75 15.75h7.5v4.5h-7.5z" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users-change-password') }}"
                                class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                                Change password
                            </a>
                        </li>
                    </ul>

                    <div class="border-t border-gray-100 dark:border-gray-800 py-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- ── Sidebar ── --}}
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full sm:translate-x-0 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800"
        aria-label="Sidebar">

        <div class="h-full flex flex-col px-3 py-4 overflow-y-auto">
            <nav class="flex-1 space-y-0.5">

                @php
                $navItem = 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-600 dark:text-gray-400 hover:bg-indigo-50 dark:hover:bg-indigo-950/40 hover:text-indigo-700 dark:hover:text-indigo-300 transition-all group';
                $navItemActive = 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium bg-indigo-50 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-300';
                $iconClass = 'w-4 h-4 flex-shrink-0';
                $sectionLabel = 'px-3 pt-5 pb-1 text-xs font-semibold text-gray-400 dark:text-gray-600 uppercase tracking-wider';
                @endphp

                @if (auth()->user()->hasRole('Student'))

                <p class="{{ $sectionLabel }}">Main</p>

                <a href="{{ route('dashboard.index') }}" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('statistics.students') }}" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5V21h4.5v-7.5H3zM9.75 9V21h4.5V9h-4.5zM16.5 3.75V21H21V3.75h-4.5z" />
                    </svg>
                    Statistics
                </a>

                <a href="{{ route('learners.edit', auth()->user()->uuid) }}" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    Profile
                </a>

                <a href="{{ route('learner-training-applications.index') }}" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />
                    </svg>
                    Applications
                </a>

                @else

                @if (auth()->user()->hasRole('Center Admin') || auth()->user()->hasRole('Trainer') || auth()->user()->hasRole('Director'))
                <p class="{{ $sectionLabel }}">Main</p>
                <a href="{{ route('dashboard.index') }}" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                    Dashboard
                </a>
                @endif

                @if (auth()->user()->hasRole('Director') || auth()->user()->hasRole('Center Admin'))
                <p class="{{ $sectionLabel }}">Applications</p>

                <a href="{{ route('learner-applications-list.index') }}" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    All applications
                </a>

                <a href="{{ route('learner-training-applications.approve.application.no.batch') }}" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0" />
                    </svg>
                    No batch
                </a>

                <a href="{{ route('learner-training-applications.for.confirmation') }}" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    For confirmation
                </a>
                @endif

                @if (auth()->user()->hasRole('Trainer'))
                <p class="{{ $sectionLabel }}">Training</p>
                <a href="{{ route('training_student_activities.index') }}" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    Calendar activity
                </a>

                <a href="{{ route('training_student_batch_attendances.index') }}" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />
                    </svg>
                    My batches
                </a>
                @endif

                @if (auth()->user()->hasRole('Director'))
                <p class="{{ $sectionLabel }}">Catalogue</p>
                <a href="{{ route('centers.index') }}" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859M12 3v8.25m0 0l-3-3m3 3l3-3" />
                    </svg>
                    Centers
                </a>

                <a href="{{ route('training_courses.index') }}" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    Courses
                </a>
                @endif

                @if (auth()->user()->hasRole('Center Admin'))
                <p class="{{ $sectionLabel }}">Management</p>
                <a href="{{ route('training_batches.index') }}" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                    Batches
                </a>

                <a href="{{ route('training_schedule_items.index') }}" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    Schedule
                </a>
                @endif

                @if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Director'))
                <p class="{{ $sectionLabel }}">Admin</p>
                @endif

                @if (auth()->user()->hasRole('Super Admin'))
                <a href="#" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Activity logs
                </a>

                <a href="{{ route('roles.index') }}" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                    Roles
                </a>
                @endif

                @if (auth()->user()->hasRole('Director') || auth()->user()->hasRole('Super Admin'))
                <a href="{{ route('users.index') }}" class="{{ $navItem }}">
                    <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    Users
                </a>
                @endif

                @endif
            </nav>
        </div>
    </aside>

    {{-- ── Dark mode script ── --}}
    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const lightIcon = document.getElementById('theme-toggle-light-icon');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');

        function applyTheme(theme) {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                lightIcon.classList.remove('hidden');
                darkIcon.classList.add('hidden');
            } else {
                document.documentElement.classList.remove('dark');
                lightIcon.classList.add('hidden');
                darkIcon.classList.remove('hidden');
            }
        }

        const saved = localStorage.getItem('color-theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        applyTheme(saved ?? (prefersDark ? 'dark' : 'light'));

        themeToggleBtn.addEventListener('click', () => {
            const isDark = document.documentElement.classList.contains('dark');
            const next = isDark ? 'light' : 'dark';
            localStorage.setItem('color-theme', next);
            applyTheme(next);
        });
    </script>
</div>