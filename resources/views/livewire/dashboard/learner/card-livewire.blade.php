<div>
    <!-- resources/views/livewire/dashboard/card-dashboard-livewire.blade.php -->
    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <!-- Learner Active Training Course -->
        <div class="w-full">
            <div class="p-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1 hover:scale-[1.02] relative min-h-32">

                <!-- Loading Skeleton -->
                <div wire:loading wire:target="render" class="absolute inset-0 bg-white dark:bg-gray-800 rounded-lg flex items-center justify-center z-10">
                    <div class="flex flex-col items-center gap-3 w-full p-5">
                        <div class="w-10 h-10 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded-xl animate-pulse"></div>
                        <div class="w-24 h-4 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded animate-pulse"></div>
                        <div class="w-16 h-8 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded animate-pulse"></div>
                    </div>
                </div>

                <!-- Content -->
                <div wire:loading.remove wire:target="render">
                    <!-- Header -->
                    <div class="flex flex-col mb-7">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-300 dark:from-blue-900 dark:to-blue-700 rounded-xl flex items-center justify-center shadow-inner">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                </svg>
                            </div>
                            <div>
                                <h6 class="text-sm font-semibold text-gray-700 dark:text-gray-200 tracking-wide">Learner Active Training Course</h6>
                                <p class="text-xs text-gray-500 dark:text-gray-400 -mt-0.5">Ongoing training enrollments</p>
                            </div>
                        </div>
                    </div>

                    <!-- Value -->
                    <p class="text-4xl font-bold text-gray-700 dark:text-white mb-1 leading-none">
                        {{ 0 }}
                    </p>
                </div>
            </div>
        </div>


        <!-- Learner Training History -->
        <div class="w-full">
            <div class="p-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1 hover:scale-[1.02] relative min-h-32">

                <!-- Loading Skeleton -->
                <div wire:loading wire:target="render" class="absolute inset-0 bg-white dark:bg-gray-800 rounded-lg flex items-center justify-center z-10">
                    <div class="flex flex-col items-center gap-3 w-full p-5">
                        <div class="w-10 h-10 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded-xl animate-pulse"></div>
                        <div class="w-24 h-4 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded animate-pulse"></div>
                        <div class="w-16 h-8 bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded animate-pulse"></div>
                    </div>
                </div>

                <!-- Content -->
                <div wire:loading.remove wire:target="render">
                    <!-- Header -->
                    <div class="flex flex-col mb-7">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-300 dark:from-green-900 dark:to-green-700 rounded-xl flex items-center justify-center shadow-inner">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h6 class="text-sm font-semibold text-gray-700 dark:text-gray-200 tracking-wide">Learner Training History</h6>
                                <p class="text-xs text-gray-500 dark:text-gray-400 -mt-0.5">Completed course records</p>
                            </div>
                        </div>
                    </div>

                    <!-- Value -->
                    <p class="text-4xl font-bold text-gray-700 dark:text-white mb-1 leading-none">
                        {{ 0 }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>