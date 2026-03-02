<div>
    <div class="max-w-full mx-auto">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            {{-- Header --}}
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 bg-blue-50 dark:bg-gray-600">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $isEditMode ? 'Update Learner Information' : 'New Learner Registration' }}
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                        {{ $isEditMode ? 'Update the learner details and personal information' : 'Complete all required fields to register a new learner' }}
                    </p>
                </div>

                @if($isEditMode)
                <div class="flex flex-col items-end">
                    <div class="flex items-center gap-2 bg-red-50 border border-red-100 rounded-xl px-4 py-2.5">
                        <svg class="w-3.5 h-3.5 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <div>
                            <p class="text-[10px] font-semibold text-red-400 uppercase tracking-wider leading-none mb-0.5">Unique Learner Identifier</p>
                            <p class="text-sm font-bold text-red-700 font-mono tracking-widest">{{ strtoupper($uli) }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Success Message --}}
            @if(session()->has('success'))
            <div class="m-4 md:m-5 p-4 text-green-800 bg-green-50 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
            @endif

            <form wire:submit.prevent="save">
                {{-- Basic Information --}}
                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        {{-- Client Type --}}
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Client Type</label>
                            <select wire:model="client_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Select client type</option>
                                <option value="tvet_graduating_student">TVET Graduating Student</option>
                                <option value="tvet_graduate">TVET Graduate</option>
                                <option value="industry_worker">Industry Worker</option>
                                <option value="k12">K12</option>
                                <option value="owf">OWF</option>
                            </select>
                            @error('client_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Picture Upload --}}
                        {{-- Picture Upload --}}
                        <div class="md:col-span-3">
                            <label for="picture" class="block mb-2 text-sm font-medium text-gray-900">
                                Profile Picture
                            </label>
                            <input
                                type="file"
                                id="picture"
                                wire:model="picture"
                                accept="image/*" ,
                                autocomplete="off"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">

                            @if ($picture && is_object($picture))
                            <div class="mt-2">
                                <img src="{{ $picture->temporaryUrl() }}"
                                    class="h-20 w-20 object-cover rounded-lg border">
                                <p class="text-xs text-gray-500 mt-1">New photo selected</p>
                            </div>

                            @elseif ($currentPicturePath)
                            {{-- Existing photo from S3 --}}
                            <div class="mt-2">
                                <img src="{{ Storage::disk('s3')->temporaryUrl($currentPicturePath, now()->addMinutes(5)) }}"
                                    class="h-20 w-20 object-cover rounded-lg border">
                                <p class="text-xs text-gray-500 mt-1">Current photo</p>
                            </div>
                            @endif

                            @error('picture')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- School Information --}}
                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">School Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="school_name" class="block mb-2 text-sm font-medium text-gray-900">School Name</label>
                            <input type="text" id="school_name" wire:model="school_name" class="bg-gray-50 border @error('school_name') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g. XYZ Technical School">
                            @error('school_name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="school_address" class="block mb-2 text-sm font-medium text-gray-900">School Address</label>
                            <textarea id="school_address" wire:model="school_address" rows="1" class="bg-gray-50 border @error('school_address') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Complete school address"></textarea>
                            @error('school_address')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Personal Information --}}
                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h2>
                    <p class="text-xs text-gray-500 mb-4">
                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        Personal information is encrypted and stored securely
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Sex</label>
                            <select wire:model="sex" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Select sex</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Civil Status</label>
                            <select wire:model="civil_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Select civil status</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="widow">Widow</option>
                                <option value="separated">Separated</option>
                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Date of Birth</label>
                            <input type="date" wire:model="birth_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Place of Birth</label>
                            <input type="text" wire:model="birth_place" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="City/Municipality, Province">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Mother's Name</label>
                            <input type="text" wire:model="mother_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Full name">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Father's Name</label>
                            <input type="text" wire:model="father_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Full name">
                        </div>
                    </div>
                </div>

                {{-- Address Information --}}
                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Address Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900">House/Block/Lot No., Street</label>
                            <input type="text" wire:model="address_number_street" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g. Block 5 Lot 12, Main Street">
                        </div>
                        <div><label class="block mb-2 text-sm font-medium text-gray-900">Barangay</label><input type="text" wire:model="address_barangay" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Barangay name"></div>
                        <div><label class="block mb-2 text-sm font-medium text-gray-900">District</label><input type="text" wire:model="address_district" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="District"></div>
                        <div><label class="block mb-2 text-sm font-medium text-gray-900">City/Municipality</label><input type="text" wire:model="address_city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="City"></div>
                        <div><label class="block mb-2 text-sm font-medium text-gray-900">Province</label><input type="text" wire:model="address_province" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Province"></div>
                        <div><label class="block mb-2 text-sm font-medium text-gray-900">Region</label><input type="text" wire:model="address_region" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Region"></div>
                        <div><label class="block mb-2 text-sm font-medium text-gray-900">ZIP Code</label><input type="text" wire:model="address_zip_code" maxlength="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="ZIP Code"></div>
                    </div>
                </div>

                {{-- Contact Information --}}
                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><label class="block mb-2 text-sm font-medium text-gray-900">Mobile Number</label><input type="tel" wire:model="contact_mobile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g. +639123456789"></div>
                        <div><label class="block mb-2 text-sm font-medium text-gray-900">Telephone</label><input type="tel" wire:model="contact_tel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g. (02) 1234-5678"></div>
                        <div><label class="block mb-2 text-sm font-medium text-gray-900">Email Address</label><input type="email" wire:model="contact_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="email@example.com"></div>
                        <div><label class="block mb-2 text-sm font-medium text-gray-900">Fax Number</label><input type="tel" wire:model="contact_fax" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Fax number"></div>
                        <div class="md:col-span-2"><label class="block mb-2 text-sm font-medium text-gray-900">Other Contact Information</label><input type="text" wire:model="contact_others" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Other contact details"></div>
                    </div>
                </div>

                {{-- Educational Background --}}
                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Educational Background</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Highest Educational Attainment</label>
                            <select wire:model="educational_attainment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Select educational attainment</option>
                                <option value="elementary_graduate">Elementary Graduate</option>
                                <option value="high_school_graduate">High School Graduate</option>
                                <option value="tvet_graduate">TVET Graduate</option>
                                <option value="college_level">College Level</option>
                                <option value="college_graduate">College Graduate</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div><label class="block mb-2 text-sm font-medium text-gray-900">If Others, Please Specify</label><input type="text" wire:model="educational_attainment_others" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Specify other educational attainment"></div>
                    </div>
                </div>

                {{-- Employment Information --}}
                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Employment Information</h2>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Employment Status</label>
                        <select wire:model="employment_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Select employment status</option>
                            <option value="casual">Casual</option>
                            <option value="job_order">Job Order</option>
                            <option value="probationary">Probationary</option>
                            <option value="permanent">Permanent</option>
                            <option value="self_employed">Self-Employed</option>
                            <option value="ofw">OFW</option>
                        </select>
                    </div>
                </div>

                {{-- Work Experiences --}}
                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Work Experiences</h2>
                        <button type="button" wire:click="addWorkExperience" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">+ Add Work Experience</button>
                    </div>
                    <div class="space-y-3">
                        @forelse($work_experiences as $index => $experience)
                        <div class="p-4 border border-gray-300 rounded-lg bg-gray-50" wire:key="work-exp-{{ $index }}">
                            <div class="flex justify-between items-center mb-3">
                                <h4 class="font-medium text-gray-900">Work Experience #{{ $index + 1 }}</h4>
                                <button type="button" wire:click="removeWorkExperience({{ $index }})" class="text-red-600 hover:text-red-800"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg></button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <input type="text" wire:model="work_experiences.{{ $index }}.company" placeholder="Company Name" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="work_experiences.{{ $index }}.position" placeholder="Position" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="work_experiences.{{ $index }}.duration" placeholder="Duration (e.g., 2020-2023)" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <textarea wire:model="work_experiences.{{ $index }}.responsibilities" placeholder="Responsibilities" rows="2" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500 text-center py-4">No work experiences added yet.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Trainings --}}
                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Training/Seminars Attended</h2>
                        <button type="button" wire:click="addTraining" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">+ Add Training</button>
                    </div>
                    <div class="space-y-3">
                        @forelse($trainings as $index => $training)
                        <div class="p-4 border border-gray-300 rounded-lg bg-gray-50" wire:key="training-{{ $index }}">
                            <div class="flex justify-between items-center mb-3">
                                <h4 class="font-medium text-gray-900">Training #{{ $index + 1 }}</h4>
                                <button type="button" wire:click="removeTraining({{ $index }})" class="text-red-600 hover:text-red-800"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg></button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <input type="text" wire:model="trainings.{{ $index }}.title" placeholder="Training Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="trainings.{{ $index }}.provider" placeholder="Training Provider" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="trainings.{{ $index }}.date" placeholder="Date (e.g., January 2023)" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="trainings.{{ $index }}.hours" placeholder="Number of Hours" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500 text-center py-4">No trainings added yet.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Licensure Examination --}}
                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Licensure Examinations</h2>
                        <button type="button" wire:click="addLicensure" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">+ Add Licensure</button>
                    </div>
                    <div class="space-y-3">
                        @forelse($licensure_examination as $index => $licensure)
                        <div class="p-4 border border-gray-300 rounded-lg bg-gray-50" wire:key="licensure-{{ $index }}">
                            <div class="flex justify-between items-center mb-3">
                                <h4 class="font-medium text-gray-900">Licensure #{{ $index + 1 }}</h4>
                                <button type="button" wire:click="removeLicensure({{ $index }})" class="text-red-600 hover:text-red-800"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg></button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <input type="text" wire:model="licensure_examination.{{ $index }}.title" placeholder="Examination Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="licensure_examination.{{ $index }}.license_number" placeholder="License Number" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="licensure_examination.{{ $index }}.date_taken" placeholder="Date Taken" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="licensure_examination.{{ $index }}.validity" placeholder="Validity Period" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500 text-center py-4">No licensure examinations added yet.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Competency Assessment --}}
                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Competency Assessments</h2>
                        <button type="button" wire:click="addCompetency" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">+ Add Assessment</button>
                    </div>
                    <div class="space-y-3">
                        @forelse($competency_assessment as $index => $competency)
                        <div class="p-4 border border-gray-300 rounded-lg bg-gray-50" wire:key="competency-{{ $index }}">
                            <div class="flex justify-between items-center mb-3">
                                <h4 class="font-medium text-gray-900">Assessment #{{ $index + 1 }}</h4>
                                <button type="button" wire:click="removeCompetency({{ $index }})" class="text-red-600 hover:text-red-800"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg></button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <input type="text" wire:model="competency_assessment.{{ $index }}.qualification" placeholder="Qualification Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="competency_assessment.{{ $index }}.certificate_number" placeholder="Certificate Number" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="competency_assessment.{{ $index }}.date_issued" placeholder="Date Issued" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="competency_assessment.{{ $index }}.expiry_date" placeholder="Expiry Date" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500 text-center py-4">No competency assessments added yet.</p>
                        @endforelse
                    </div>
                </div>

                {{-- User Documents --}}
                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Documents</h2>
                        <button type="button" wire:click="addDocument" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">+ Add Document</button>
                    </div>
                    <div class="space-y-3">
                        @forelse($documents as $index => $document)
                        <div class="p-4 border border-gray-300 rounded-lg bg-gray-50" wire:key="document-{{ $index }}">
                            <div class="flex justify-between items-center mb-3">
                                <h4 class="font-medium text-gray-900">Document #{{ $index + 1 }}</h4>
                                <button
                                    wire:click="removeDocument({{ $index }})"
                                    wire:confirm="Are you sure you want to remove this document? This will permanently delete the file and cannot be undone."
                                    class="text-red-600 hover:text-red-800"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <select wire:model.live="documents.{{ $index }}.type" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="">Select document type</option>
                                    @foreach(\App\Enums\DocumentTypeEnum::cases() as $type)
                                    <option value="{{ $type->value }}">{{ str_replace('_', ' ', $type->name) }}</option>
                                    @endforeach
                                </select>
                                <input type="file"
                                    id="picture"
                                    wire:model.live="documents.{{ $index }}.file"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">

                                @if(isset($document['file']) && is_string($document['file']))
                                <div class="mt-2 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                    </svg>
                                    <a href="{{ Storage::disk('s3')->temporaryUrl($document['file'], now()->addMinute(1)) }}" target="_blank" class="text-sm text-blue-600 hover:underline truncate">
                                        {{ basename($document['file']) }}
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500 text-center py-4">No documents added yet.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Terms and Conditions --}}
                <div class="p-4 md:p-5 border-b border-gray-200">
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.955 11.955 0 003 10c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.249-8.25-3.286z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-gray-800 mb-1">Certification & Agreement</h4>
                                <p class="text-xs text-gray-500 leading-relaxed mb-4">
                                    I hereby certify that the information provided above is true and correct to the best of my knowledge.
                                    I understand that any false statement or misrepresentation may result in the revocation of my TESDA
                                    accreditation or disqualification from training and assessment activities.
                                </p>
                                <label class="flex items-start gap-3 cursor-pointer group">
                                    <div class="relative flex-shrink-0 mt-0.5">
                                        <input
                                            type="checkbox"
                                            wire:model="agreedToTerms"
                                            class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 focus:ring-2 cursor-pointer">
                                    </div>
                                    <span class="text-xs text-gray-600 group-hover:text-gray-800 transition-colors leading-relaxed">
                                        I have read, understood, and agree to the above certification statement and <a href="{{ route('data.privacy' ) }}" class="text-blue-500 underline">data privacy</a>
                                        <span class="text-red-500 ml-0.5">*</span>
                                    </span>
                                </label>
                                @error('agreedToTerms')
                                <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="flex flex-wrap items-center gap-3 p-4 md:p-5 border-t border-gray-200 rounded-b">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">{{ $isEditMode ? 'Update Student Profile Details' : 'Register Learner' }}</button>
                    @if($isEditMode)
                    <!-- <button type="button" onclick="confirm('Are you sure you want to delete this learner? This action cannot be undone.') || event.stopImmediatePropagation()" wire:click="deleteLearner" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">Delete Learner</button> -->
                    @endif
                    <!-- <a href="{{ route('learner.profile.index') }}" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700">Cancel</a> -->
                </div>
            </form>
        </div>
    </div>
</div>