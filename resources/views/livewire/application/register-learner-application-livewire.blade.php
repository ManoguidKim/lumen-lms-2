<div>
    <div class="max-w-full mx-auto">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            {{-- Header --}}
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 bg-blue-50 dark:bg-gray-600">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        New Learner Registration
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                        Complete all required fields to register a new learner
                    </p>
                </div>
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
                        {{-- First Name --}}
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                wire:model="firstName"
                                class="bg-gray-50 border @error('firstName') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter first name">
                            @error('firstName')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Middle Name --}}
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Middle Name
                            </label>
                            <input
                                type="text"
                                wire:model="middleName"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter middle name">
                            @error('middleName')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Last Name --}}
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                wire:model="lastName"
                                class="bg-gray-50 border @error('lastName') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Enter last name">
                            @error('lastName')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Suffix --}}
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Suffix
                            </label>
                            <input
                                type="text"
                                wire:model="suffix"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Jr., Sr., III, etc."
                                maxlength="10">
                            @error('suffix')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Other Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        {{-- Client Type --}}
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Client Type</label>
                            <select wire:model="clientType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Select client type</option>
                                <option value="tvet_graduating_student">TVET Graduating Student</option>
                                <option value="tvet_graduate">TVET Graduate</option>
                                <option value="industry_worker">Industry Worker</option>
                                <option value="k12">K12</option>
                                <option value="owf">OWF</option>
                            </select>
                            @error('clientType')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Picture Upload --}}
                        <div class="md:col-span-3">
                            <label for="picture" class="block mb-2 text-sm font-medium text-gray-900">
                                Profile Picture
                            </label>
                            <input
                                type="file"
                                id="picture"
                                wire:model="picture"
                                accept="image/*"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">

                            @if ($picture)
                            <div class="mt-2">
                                <img src="{{ $picture->temporaryUrl() }}" class="h-20 w-20 object-cover rounded-lg">
                            </div>
                            @elseif($currentPicturePath)
                            <p class="mt-1 text-sm text-gray-500">Current picture: {{ basename($currentPicturePath) }}</p>
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
                            <label for="schoolName" class="block mb-2 text-sm font-medium text-gray-900">School Name</label>
                            <input type="text" id="schoolName" wire:model="schoolName" class="bg-gray-50 border @error('schoolName') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g. XYZ Technical School">
                            @error('schoolName')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="schoolAddress" class="block mb-2 text-sm font-medium text-gray-900">School Address</label>
                            <textarea id="schoolAddress" wire:model="schoolAddress" rows="1" class="bg-gray-50 border @error('schoolAddress') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Complete school address"></textarea>
                            @error('schoolAddress')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
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
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Sex <span class="text-red-500">*</span>
                            </label>
                            <select wire:model="sex" class="bg-gray-50 border @error('sex') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Select sex</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            @error('sex')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Civil Status <span class="text-red-500">*</span>
                            </label>
                            <select wire:model="civilStatus" class="bg-gray-50 border @error('civilStatus') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Select civil status</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="widow">Widow</option>
                                <option value="separated">Separated</option>
                            </select>
                            @error('civilStatus')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Date of Birth <span class="text-red-500">*</span>
                            </label>
                            <input type="date" wire:model="birthDate" class="bg-gray-50 border @error('birthDate') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @error('birthDate')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Place of Birth</label>
                            <input type="text" wire:model="birthPlace" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="City/Municipality, Province">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Mother's Name</label>
                            <input type="text" wire:model="motherName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Full name">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Father's Name</label>
                            <input type="text" wire:model="fatherName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Full name">
                        </div>
                    </div>
                </div>

                {{-- Address Information --}}
                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Address Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900">House/Block/Lot No., Street</label>
                            <input type="text" wire:model="addressNumberStreet" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g. Block 5 Lot 12, Main Street">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Barangay</label><input type="text" wire:model="addressBarangay" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Barangay name">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">District</label><input type="text" wire:model="addressDistrict" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="District">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">City/Municipality</label><input type="text" wire:model="addressCity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="City">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Province</label><input type="text" wire:model="addressProvince" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Province">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Region</label><input type="text" wire:model="addressRegion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Region">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">ZIP Code</label><input type="text" wire:model="addressZipCode" maxlength="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="ZIP Code">
                        </div>
                    </div>
                </div>

                {{-- Contact Information --}}
                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Mobile Number <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" wire:model="contactMobile" class="bg-gray-50 border @error('contactMobile') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g. +639123456789">
                            @error('contactMobile')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Telephone</label><input type="tel" wire:model="contactTel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g. (02) 1234-5678">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Email Address</label><input type="email" wire:model="contactEmail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="email@example.com">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Fax Number</label><input type="tel" wire:model="contactFax" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Fax number">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Other Contact Information</label><input type="text" wire:model="contactOthers" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Other contact details">
                        </div>
                    </div>
                </div>

                {{-- Educational Background --}}
                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Educational Background</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Highest Educational Attainment</label>
                            <select wire:model="educationalAttainment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Select educational attainment</option>
                                <option value="elementary_graduate">Elementary Graduate</option>
                                <option value="high_school_graduate">High School Graduate</option>
                                <option value="tvet_graduate">TVET Graduate</option>
                                <option value="college_level">College Level</option>
                                <option value="college_graduate">College Graduate</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div><label class="block mb-2 text-sm font-medium text-gray-900">If Others, Please Specify</label><input type="text" wire:model="educationalAttainmentOthers" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Specify other educational attainment"></div>
                    </div>
                </div>

                {{-- Employment Information --}}
                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Employment Information</h2>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Employment Status</label>
                        <select wire:model="employmentStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
                        @forelse($workExperiences as $index => $experience)
                        <div class="p-4 border border-gray-300 rounded-lg bg-gray-50" wire:key="work-exp-{{ $index }}">
                            <div class="flex justify-between items-center mb-3">
                                <h4 class="font-medium text-gray-900">Work Experience #{{ $index + 1 }}</h4>
                                <button type="button" wire:click="removeWorkExperience({{ $index }})" class="text-red-600 hover:text-red-800"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <input type="text" wire:model="workExperiences.{{ $index }}.company" placeholder="Company Name" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="workExperiences.{{ $index }}.position" placeholder="Position" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="workExperiences.{{ $index }}.duration" placeholder="Duration (e.g., 2020-2023)" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <textarea wire:model="workExperiences.{{ $index }}.responsibilities" placeholder="Responsibilities" rows="2" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
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
                        @forelse($licensureExamination as $index => $licensure)
                        <div class="p-4 border border-gray-300 rounded-lg bg-gray-50" wire:key="licensure-{{ $index }}">
                            <div class="flex justify-between items-center mb-3">
                                <h4 class="font-medium text-gray-900">Licensure #{{ $index + 1 }}</h4>
                                <button type="button" wire:click="removeLicensure({{ $index }})" class="text-red-600 hover:text-red-800"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg></button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <input type="text" wire:model="licensureExamination.{{ $index }}.title" placeholder="Examination Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="licensureExamination.{{ $index }}.license_number" placeholder="License Number" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="licensureExamination.{{ $index }}.date_taken" placeholder="Date Taken" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="licensureExamination.{{ $index }}.validity" placeholder="Validity Period" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
                        @forelse($competencyAssessment as $index => $competency)
                        <div class="p-4 border border-gray-300 rounded-lg bg-gray-50" wire:key="competency-{{ $index }}">
                            <div class="flex justify-between items-center mb-3">
                                <h4 class="font-medium text-gray-900">Assessment #{{ $index + 1 }}</h4>
                                <button type="button" wire:click="removeCompetency({{ $index }})" class="text-red-600 hover:text-red-800"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg></button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <input type="text" wire:model="competencyAssessment.{{ $index }}.qualification" placeholder="Qualification Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="competencyAssessment.{{ $index }}.certificate_number" placeholder="Certificate Number" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="competencyAssessment.{{ $index }}.date_issued" placeholder="Date Issued" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" wire:model="competencyAssessment.{{ $index }}.expiry_date" placeholder="Expiry Date" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500 text-center py-4">No competency assessments added yet.</p>
                        @endforelse
                    </div>
                </div>

                <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Training Course and Batch Assignement</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Training Course --}}
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">
                                Training Course <span class="text-red-500">*</span>
                            </label>
                            <select
                                wire:model.live="courseId"
                                class="bg-gray-50 border @error('courseId') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                <option value="">Select training course</option>
                                @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }} - {{ $course->course_code }}</option>
                                @endforeach
                            </select>
                            @error('courseId')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Training Course Batch --}}
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Student Training Batch <span class="text-red-500">*</span>
                            </label>

                            <select
                                wire:model.live="batchId"
                                class="bg-gray-50 border @error('batchId') border-red-500 @else border-gray-300 @enderror
               text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
               block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">

                                <option value="" class="text-gray-400">
                                    — Select a training batch —
                                </option>

                                @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}">
                                    {{ $batch->batch_name }}
                                    • {{ $batch->batch_code }}
                                    ({{ \Carbon\Carbon::parse($batch->start_date)->format('M d, Y') }}
                                    – {{ \Carbon\Carbon::parse($batch->end_date)->format('M d, Y') }})
                                </option>
                                @endforeach
                            </select>

                            @error('batchId')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="flex flex-wrap items-center gap-3 p-4 md:p-5 border-t border-gray-200 rounded-b">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Register new applicants
                    </button>

                    <a
                        href="{{ route('learner-training-applications.index') }}"
                        class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                        <svg class="w-4 h-4 inline mr-2 -mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to List
                    </a>
                </div>
            </form>
        </div>
    </div>


</div>