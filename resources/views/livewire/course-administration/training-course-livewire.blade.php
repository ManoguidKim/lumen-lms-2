<div>
    <div class="relative overflow-x-auto shadow-xs sm:rounded-lg mt-3">
        <div class="flex flex-col sm:flex-row flex-wrap items-center justify-between pb-4 space-y-4 sm:space-y-0">
            <div>
                <a href="{{ route('training_courses.create') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="-ml-1 mr-2 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Create New Training Course
                </a>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="table-search-users" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder-gray-400" placeholder="Search course" wire:model.live="search">
            </div>
        </div>

        <div class="relative overflow-hidden shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-indigo-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">
                                #
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Code
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Course Name
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Description
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Duration
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Is Tesda Course
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Tr No.
                            </th>
                            <th scope="col" class="px-4 py-3">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-400">
                            <td scope="row" class="px-4 py-3 font-extrabold text-gray-600 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </td>
                            <td scope="row" class="px-4 py-3 font-extrabold text-gray-600 whitespace-nowrap dark:text-white">
                                {{ $course->course_code }}
                            </td>
                            <td class="px-4 py-3 text-gray-600 dark:text-white">
                                {{ $course->course_name }}
                            </td>
                            <td class="px-4 py-3 text-gray-600 dark:text-white">
                                {{ $course->description }}
                            </td>
                            <td class="px-4 py-3 text-gray-600 dark:text-white">
                                {{ $course->duration_hours }} hours
                            </td>
                            <td class="px-4 py-3 text-gray-600 dark:text-white">
                                {{ $course->is_tesda_course ? 'Yes' : 'No' }}
                            </td>
                            <td class="px-4 py-3 text-gray-600 dark:text-white">
                                {{ $course->tr_number }}
                            </td>
                            <td class="px-4 py-3 text-gray-600 text-right whitespace-nowrap dark:text-white space-x-2">
                                <a href="{{ route('training_courses.show', $course->uuid) }}"
                                    class="inline-flex items-center text-green-600 hover:underline font-bold">
                                    <svg class="w-4 h-4 me-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    View
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-gray-500 dark:text-gray-300">
                                <div class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                    <div class="text-center py-12">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-500 dark:text-white">No training course found</h3>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="py-3">
            {{ $courses->links() }}
        </div>
    </div>
</div>