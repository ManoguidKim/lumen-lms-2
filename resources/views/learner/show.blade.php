<x-layouts.app.flowbite>
     <div class="mx-auto max-w-full">
          <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

               {{-- Header --}}
               <div class="border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white px-6 py-5 dark:border-gray-800 dark:from-blue-500/10 dark:to-gray-900">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                         <div class="flex items-start gap-4">
                              <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                                   <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                   </svg>
                              </div>

                              <div>
                                   <h1 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                        Learner Update
                                   </h1>
                                   <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        Update the learner details and personal information.
                                   </p>
                              </div>
                         </div>

                         <div class="flex items-start">
                              <div class="inline-flex items-center gap-2 rounded-2xl border border-red-200 bg-red-50 px-4 py-2.5 text-red-700 shadow-sm dark:border-red-900/40 dark:bg-red-500/10 dark:text-red-300">
                                   <svg class="h-4 w-4 flex-shrink-0 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                   </svg>
                                   <div>
                                        <p class="text-[10px] font-semibold uppercase tracking-wider text-red-400">Unique Learner Identifier</p>
                                        <p class="font-mono text-sm font-bold tracking-widest">{{ strtoupper($learner->uli) }}</p>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               {{-- Alerts --}}
               @if(session('success'))
               <div class="mx-6 mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 shadow-sm dark:border-emerald-900/40 dark:bg-emerald-500/10 dark:text-emerald-300">
                    {{ session('success') }}
               </div>
               @endif

               @if(session('error'))
               <div class="mx-6 mt-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-800 shadow-sm dark:border-red-900/40 dark:bg-red-500/10 dark:text-red-300">
                    {{ session('error') }}
               </div>
               @endif

               <form action="{{ route('learners.update', $learner->uuid) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div id="deleted-document-ids-container"></div>

                    {{-- Basic Information --}}
                    <div class="px-6 pt-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-blue-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Basic Information</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Client profile and photo information</p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Client Type</label>
                                   <select name="client_type" class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                        <option value="">Select client type</option>
                                        <option value="tvet_graduating_student" @selected(old('client_type', $learner->client_type) === 'tvet_graduating_student')>TVET Graduating Student</option>
                                        <option value="tvet_graduate" @selected(old('client_type', $learner->client_type) === 'tvet_graduate')>TVET Graduate</option>
                                        <option value="industry_worker" @selected(old('client_type', $learner->client_type) === 'industry_worker')>Industry Worker</option>
                                        <option value="k12" @selected(old('client_type', $learner->client_type) === 'k12')>K12</option>
                                        <option value="owf" @selected(old('client_type', $learner->client_type) === 'owf')>OWF</option>
                                   </select>
                                   @error('client_type')<p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                              </div>

                              <div class="md:col-span-2">
                                   <label for="picture" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Profile Picture</label>
                                   <input type="file" id="picture" name="picture" accept="image/*"
                                        class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-blue-700 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                                        onchange="previewPicture(this)">

                                   <div id="picture-preview" class="mt-3 {{ $learner->picture_path ? '' : 'hidden' }}">
                                        @if($learner->picture_path)
                                        <img id="picture-preview-img"
                                             src="{{ Storage::disk('s3')->temporaryUrl($learner->picture_path, now()->addMinutes(5)) }}"
                                             class="h-20 w-20 rounded-2xl border border-gray-200 object-cover shadow-sm dark:border-gray-700">
                                        <p id="picture-preview-label" class="mt-1 text-xs text-gray-500 dark:text-gray-400">Current photo</p>
                                        @else
                                        <img id="picture-preview-img" src="" class="hidden h-20 w-20 rounded-2xl border border-gray-200 object-cover shadow-sm dark:border-gray-700">
                                        <p id="picture-preview-label" class="mt-1 hidden text-xs text-gray-500 dark:text-gray-400"></p>
                                        @endif
                                   </div>
                                   @error('picture')<p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                              </div>
                         </div>
                    </div>

                    {{-- School Information --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-emerald-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">School Information</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">School name and location details</p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div>
                                   <label for="school_name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">School Name</label>
                                   <input type="text" id="school_name" name="school_name"
                                        value="{{ old('school_name', $learner->school_name) }}"
                                        class="block w-full rounded-2xl border @error('school_name') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100 dark:bg-gray-800 dark:text-white"
                                        placeholder="e.g. XYZ Technical School">
                                   @error('school_name')<p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                              </div>

                              <div>
                                   <label for="school_address" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">School Address</label>
                                   <textarea id="school_address" name="school_address" rows="1"
                                        class="block w-full rounded-2xl border @error('school_address') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-emerald-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100 dark:bg-gray-800 dark:text-white"
                                        placeholder="Complete school address">{{ old('school_address', $learner->school_address) }}</textarea>
                                   @error('school_address')<p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                              </div>
                         </div>
                    </div>

                    {{-- Personal Information --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-violet-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Personal Information</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Protected personal profile details</p>
                              </div>
                         </div>

                         <div class="mb-4 rounded-2xl border border-violet-200 bg-violet-50 px-4 py-3 text-xs text-violet-700 dark:border-violet-900/40 dark:bg-violet-500/10 dark:text-violet-300">
                              Personal information is encrypted and stored securely.
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Sex</label>
                                   <select name="sex" class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-violet-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-violet-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                        <option value="">Select sex</option>
                                        <option value="male" @selected(old('sex', $learner->sex) === 'male')>Male</option>
                                        <option value="female" @selected(old('sex', $learner->sex) === 'female')>Female</option>
                                   </select>
                              </div>

                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Civil Status</label>
                                   <select name="civil_status" class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-violet-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-violet-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                        <option value="">Select civil status</option>
                                        <option value="single" @selected(old('civil_status', $learner->civil_status) === 'single')>Single</option>
                                        <option value="married" @selected(old('civil_status', $learner->civil_status) === 'married')>Married</option>
                                        <option value="widow" @selected(old('civil_status', $learner->civil_status) === 'widow')>Widow</option>
                                        <option value="separated" @selected(old('civil_status', $learner->civil_status) === 'separated')>Separated</option>
                                   </select>
                              </div>

                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Birth</label>
                                   <input type="date" name="birth_date"
                                        value="{{ old('birth_date', $learner->birth_date) }}"
                                        class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-violet-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-violet-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                              </div>

                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Place of Birth</label>
                                   <input type="text" name="birth_place"
                                        value="{{ old('birth_place', $learner->birth_place) }}"
                                        class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-violet-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-violet-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                                        placeholder="City/Municipality, Province">
                              </div>

                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Mother's Name</label>
                                   <input type="text" name="mother_name"
                                        value="{{ old('mother_name', $learner->mother_name) }}"
                                        class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-violet-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-violet-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                                        placeholder="Full name">
                              </div>

                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Father's Name</label>
                                   <input type="text" name="father_name"
                                        value="{{ old('father_name', $learner->father_name) }}"
                                        class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-violet-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-violet-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                                        placeholder="Full name">
                              </div>
                         </div>
                    </div>

                    {{-- Address Information --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-amber-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Address Information</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Residential location details</p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                              <div class="md:col-span-3">
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">House/Block/Lot No., Street</label>
                                   <input type="text" name="address_number_street"
                                        value="{{ old('address_number_street', $learner->address_number_street) }}"
                                        class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-amber-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-amber-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                                        placeholder="e.g. Block 5 Lot 12, Main Street">
                              </div>

                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Barangay</label>
                                   <input type="text" name="address_barangay" value="{{ old('address_barangay', $learner->address_barangay) }}" class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-amber-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-amber-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white" placeholder="Barangay name">
                              </div>

                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">District</label>
                                   <input type="text" name="address_district" value="{{ old('address_district', $learner->address_district) }}" class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-amber-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-amber-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white" placeholder="District">
                              </div>

                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">City/Municipality</label>
                                   <input type="text" name="address_city" value="{{ old('address_city', $learner->address_city) }}" class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-amber-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-amber-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white" placeholder="City">
                              </div>

                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Province</label>
                                   <input type="text" name="address_province" value="{{ old('address_province', $learner->address_province) }}" class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-amber-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-amber-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white" placeholder="Province">
                              </div>

                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Region</label>
                                   <input type="text" name="address_region" value="{{ old('address_region', $learner->address_region) }}" class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-amber-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-amber-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white" placeholder="Region">
                              </div>

                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">ZIP Code</label>
                                   <input type="text" name="address_zip_code" maxlength="10" value="{{ old('address_zip_code', $learner->address_zip_code) }}" class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-amber-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-amber-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white" placeholder="ZIP Code">
                              </div>
                         </div>
                    </div>

                    {{-- Contact Information --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-rose-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Contact Information</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Reachability and communication channels</p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Mobile Number</label>
                                   <input type="tel" name="contact_mobile" value="{{ old('contact_mobile', $learner->contact_mobile) }}" class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-rose-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-rose-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white" placeholder="e.g. +639123456789">
                              </div>

                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Telephone</label>
                                   <input type="tel" name="contact_tel" value="{{ old('contact_tel', $learner->contact_tel) }}" class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-rose-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-rose-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white" placeholder="e.g. (02) 1234-5678">
                              </div>

                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                                   <input type="email" name="contact_email" value="{{ old('contact_email', $learner->contact_email ?? $learner->email) }}" class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-rose-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-rose-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white" placeholder="email@example.com">
                                   @error('contact_email')<p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                              </div>

                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Fax Number</label>
                                   <input type="tel" name="contact_fax" value="{{ old('contact_fax', $learner->contact_fax) }}" class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-rose-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-rose-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white" placeholder="Fax number">
                              </div>

                              <div class="md:col-span-2">
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Other Contact Information</label>
                                   <input type="text" name="contact_others" value="{{ old('contact_others', $learner->contact_others) }}" class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-rose-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-rose-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white" placeholder="Other contact details">
                              </div>
                         </div>
                    </div>

                    {{-- Educational Background --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-teal-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Educational Background</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Academic attainment information</p>
                              </div>
                         </div>

                         <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Highest Educational Attainment</label>
                                   <select name="educational_attainment" class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-teal-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-teal-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                        <option value="">Select educational attainment</option>
                                        <option value="elementary_graduate" @selected(old('educational_attainment', $learner->educational_attainment) === 'elementary_graduate')>Elementary Graduate</option>
                                        <option value="high_school_graduate" @selected(old('educational_attainment', $learner->educational_attainment) === 'high_school_graduate')>High School Graduate</option>
                                        <option value="tvet_graduate" @selected(old('educational_attainment', $learner->educational_attainment) === 'tvet_graduate')>TVET Graduate</option>
                                        <option value="college_level" @selected(old('educational_attainment', $learner->educational_attainment) === 'college_level')>College Level</option>
                                        <option value="college_graduate" @selected(old('educational_attainment', $learner->educational_attainment) === 'college_graduate')>College Graduate</option>
                                        <option value="others" @selected(old('educational_attainment', $learner->educational_attainment) === 'others')>Others</option>
                                   </select>
                              </div>

                              <div>
                                   <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">If Others, Please Specify</label>
                                   <input type="text" name="educational_attainment_others"
                                        value="{{ old('educational_attainment_others', $learner->educational_attainment_others) }}"
                                        class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-teal-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-teal-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                                        placeholder="Specify other educational attainment">
                              </div>
                         </div>
                    </div>

                    {{-- Employment Information --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center gap-3">
                              <div class="h-8 w-1 rounded-full bg-cyan-500"></div>
                              <div>
                                   <h2 class="text-base font-semibold text-gray-900 dark:text-white">Employment Information</h2>
                                   <p class="text-sm text-gray-500 dark:text-gray-400">Current work status</p>
                              </div>
                         </div>

                         <div>
                              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Employment Status</label>
                              <select name="employment_status" class="block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-cyan-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-cyan-100 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                   <option value="">Select employment status</option>
                                   <option value="casual" @selected(old('employment_status', $learner->employment_status) === 'casual')>Casual</option>
                                   <option value="job_order" @selected(old('employment_status', $learner->employment_status) === 'job_order')>Job Order</option>
                                   <option value="probationary" @selected(old('employment_status', $learner->employment_status) === 'probationary')>Probationary</option>
                                   <option value="permanent" @selected(old('employment_status', $learner->employment_status) === 'permanent')>Permanent</option>
                                   <option value="self_employed" @selected(old('employment_status', $learner->employment_status) === 'self_employed')>Self-Employed</option>
                                   <option value="ofw" @selected(old('employment_status', $learner->employment_status) === 'ofw')>OFW</option>
                              </select>
                         </div>
                    </div>

                    {{-- Work Experiences --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center justify-between gap-3">
                              <div class="flex items-center gap-3">
                                   <div class="h-8 w-1 rounded-full bg-indigo-500"></div>
                                   <div>
                                        <h2 class="text-base font-semibold text-gray-900 dark:text-white">Work Experiences</h2>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Professional history and responsibilities</p>
                                   </div>
                              </div>

                              <button type="button" onclick="addWorkExperience()"
                                   class="inline-flex items-center gap-2 rounded-2xl bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-green-700">
                                   + Add Work Experience
                              </button>
                         </div>

                         <div id="work-experiences-container" data-count="{{ count($workExperiences) }}" class="space-y-4">
                              @forelse($workExperiences as $index => $experience)
                              <div class="work-experience-item rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/60">
                                   <div class="mb-3 flex items-center justify-between">
                                        <h4 class="font-medium text-gray-900 dark:text-white">Work Experience #<span class="item-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" onclick="removeItem(this,'work-experiences-container','.work-experience-item','Work Experience')" class="text-red-600 hover:text-red-800">
                                             <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                   </div>

                                   <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <input type="text" name="work_experiences[{{ $index }}][company]" value="{{ $experience['company'] ?? '' }}" placeholder="Company Name" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                        <input type="text" name="work_experiences[{{ $index }}][position]" value="{{ $experience['position'] ?? '' }}" placeholder="Position" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                        <input type="text" name="work_experiences[{{ $index }}][duration]" value="{{ $experience['duration'] ?? '' }}" placeholder="Duration (e.g., 2020-2023)" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                        <textarea name="work_experiences[{{ $index }}][responsibilities]" placeholder="Responsibilities" rows="2" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">{{ $experience['responsibilities'] ?? '' }}</textarea>
                                   </div>
                              </div>
                              @empty
                              <p class="empty-notice py-4 text-center text-sm text-gray-500">No work experiences added yet.</p>
                              @endforelse
                         </div>
                    </div>

                    {{-- Trainings --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center justify-between gap-3">
                              <div class="flex items-center gap-3">
                                   <div class="h-8 w-1 rounded-full bg-emerald-500"></div>
                                   <div>
                                        <h2 class="text-base font-semibold text-gray-900 dark:text-white">Training/Seminars Attended</h2>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Previous seminars and training records</p>
                                   </div>
                              </div>

                              <button type="button" onclick="addTraining()"
                                   class="inline-flex items-center gap-2 rounded-2xl bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-green-700">
                                   + Add Training
                              </button>
                         </div>

                         <div id="trainings-container" data-count="{{ count($trainings) }}" class="space-y-4">
                              @forelse($trainings as $index => $training)
                              <div class="training-item rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/60">
                                   <div class="mb-3 flex items-center justify-between">
                                        <h4 class="font-medium text-gray-900 dark:text-white">Training #<span class="item-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" onclick="removeItem(this,'trainings-container','.training-item','Training')" class="text-red-600 hover:text-red-800">
                                             <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                   </div>

                                   <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <input type="text" name="trainings[{{ $index }}][title]" value="{{ $training['title'] ?? '' }}" placeholder="Training Title" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                        <input type="text" name="trainings[{{ $index }}][provider]" value="{{ $training['provider'] ?? '' }}" placeholder="Training Provider" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                        <input type="text" name="trainings[{{ $index }}][date]" value="{{ $training['date'] ?? '' }}" placeholder="Date (e.g., January 2023)" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                        <input type="text" name="trainings[{{ $index }}][hours]" value="{{ $training['hours'] ?? '' }}" placeholder="Number of Hours" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                   </div>
                              </div>
                              @empty
                              <p class="empty-notice py-4 text-center text-sm text-gray-500">No trainings added yet.</p>
                              @endforelse
                         </div>
                    </div>

                    {{-- Licensure Examinations --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center justify-between gap-3">
                              <div class="flex items-center gap-3">
                                   <div class="h-8 w-1 rounded-full bg-violet-500"></div>
                                   <div>
                                        <h2 class="text-base font-semibold text-gray-900 dark:text-white">Licensure Examinations</h2>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Professional exam credentials</p>
                                   </div>
                              </div>

                              <button type="button" onclick="addLicensure()"
                                   class="inline-flex items-center gap-2 rounded-2xl bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-green-700">
                                   + Add Licensure
                              </button>
                         </div>

                         <div id="licensure-container" data-count="{{ count($licensureExamination) }}" class="space-y-4">
                              @forelse($licensureExamination as $index => $licensure)
                              <div class="licensure-item rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/60">
                                   <div class="mb-3 flex items-center justify-between">
                                        <h4 class="font-medium text-gray-900 dark:text-white">Licensure #<span class="item-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" onclick="removeItem(this,'licensure-container','.licensure-item','Licensure')" class="text-red-600 hover:text-red-800">
                                             <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                   </div>

                                   <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <input type="text" name="licensure_examination[{{ $index }}][title]" value="{{ $licensure['title'] ?? '' }}" placeholder="Examination Title" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                        <input type="text" name="licensure_examination[{{ $index }}][license_number]" value="{{ $licensure['license_number'] ?? '' }}" placeholder="License Number" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                        <input type="text" name="licensure_examination[{{ $index }}][date_taken]" value="{{ $licensure['date_taken'] ?? '' }}" placeholder="Date Taken" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                        <input type="text" name="licensure_examination[{{ $index }}][validity]" value="{{ $licensure['validity'] ?? '' }}" placeholder="Validity Period" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                   </div>
                              </div>
                              @empty
                              <p class="empty-notice py-4 text-center text-sm text-gray-500">No licensure examinations added yet.</p>
                              @endforelse
                         </div>
                    </div>

                    {{-- Competency Assessments --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center justify-between gap-3">
                              <div class="flex items-center gap-3">
                                   <div class="h-8 w-1 rounded-full bg-amber-500"></div>
                                   <div>
                                        <h2 class="text-base font-semibold text-gray-900 dark:text-white">Competency Assessments</h2>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Qualification and certification records</p>
                                   </div>
                              </div>

                              <button type="button" onclick="addCompetency()"
                                   class="inline-flex items-center gap-2 rounded-2xl bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-green-700">
                                   + Add Assessment
                              </button>
                         </div>

                         <div id="competency-container" data-count="{{ count($competencyAssessment) }}" class="space-y-4">
                              @forelse($competencyAssessment as $index => $competency)
                              <div class="competency-item rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/60">
                                   <div class="mb-3 flex items-center justify-between">
                                        <h4 class="font-medium text-gray-900 dark:text-white">Assessment #<span class="item-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" onclick="removeItem(this,'competency-container','.competency-item','Assessment')" class="text-red-600 hover:text-red-800">
                                             <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                   </div>

                                   <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <input type="text" name="competency_assessment[{{ $index }}][qualification]" value="{{ $competency['qualification'] ?? '' }}" placeholder="Qualification Title" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                        <input type="text" name="competency_assessment[{{ $index }}][certificate_number]" value="{{ $competency['certificate_number'] ?? '' }}" placeholder="Certificate Number" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                        <input type="text" name="competency_assessment[{{ $index }}][date_issued]" value="{{ $competency['date_issued'] ?? '' }}" placeholder="Date Issued" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                        <input type="text" name="competency_assessment[{{ $index }}][expiry_date]" value="{{ $competency['expiry_date'] ?? '' }}" placeholder="Expiry Date" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                   </div>
                              </div>
                              @empty
                              <p class="empty-notice py-4 text-center text-sm text-gray-500">No competency assessments added yet.</p>
                              @endforelse
                         </div>
                    </div>

                    {{-- Documents --}}
                    <div class="px-6">
                         <div class="mb-4 flex items-center justify-between gap-3">
                              <div class="flex items-center gap-3">
                                   <div class="h-8 w-1 rounded-full bg-sky-500"></div>
                                   <div>
                                        <h2 class="text-base font-semibold text-gray-900 dark:text-white">Documents</h2>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Uploaded files and supporting documents</p>
                                   </div>
                              </div>

                              <button type="button" onclick="addDocument()"
                                   class="inline-flex items-center gap-2 rounded-2xl bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-green-700">
                                   + Add Document
                              </button>
                         </div>

                         <div id="documents-container" data-count="{{ count($documents) }}" class="space-y-4">
                              @forelse($documents as $index => $document)
                              <div class="document-item rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/60" data-doc-id="{{ $document['id'] }}">
                                   <div class="mb-3 flex items-center justify-between">
                                        <h4 class="font-medium text-gray-900 dark:text-white">Document #<span class="item-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" onclick="removeDocument(this)" class="text-red-600 hover:text-red-800">
                                             <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                   </div>

                                   <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <input type="hidden" name="documents[{{ $index }}][id]" value="{{ $document['id'] }}">

                                        <select name="documents[{{ $index }}][type]" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                                             <option value="">Select document type</option>
                                             @foreach(\App\Enums\DocumentTypeEnum::cases() as $type)
                                             <option value="{{ $type->value }}" @selected($document['type']===$type->value)>
                                                  {{ str_replace('_', ' ', $type->name) }}
                                             </option>
                                             @endforeach
                                        </select>

                                        <input type="file" name="documents[{{ $index }}][file]"
                                             class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-white">

                                        @if(!empty($document['file']))
                                        <div class="md:col-span-2 flex items-center gap-2">
                                             <svg class="h-4 w-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                  <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                             </svg>
                                             <a href="{{ Storage::disk('s3')->temporaryUrl($document['file'], now()->addMinute(1)) }}"
                                                  target="_blank"
                                                  class="truncate text-sm text-blue-600 hover:underline">
                                                  {{ basename($document['file']) }}
                                             </a>
                                        </div>
                                        @endif
                                   </div>
                              </div>
                              @empty
                              <p class="empty-notice py-4 text-center text-sm text-gray-500">No documents added yet.</p>
                              @endforelse
                         </div>
                    </div>

                    {{-- Terms and Conditions --}}
                    <div class="px-6">
                         <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800/60">
                              <div class="flex items-start gap-3">
                                   <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                             <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.955 11.955 0 003 10c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.249-8.25-3.286z" />
                                        </svg>
                                   </div>

                                   <div class="flex-1">
                                        <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-100">Certification & Agreement</h4>
                                        <p class="mt-1 text-xs leading-relaxed text-gray-500 dark:text-gray-400">
                                             I hereby certify that the information provided above is true and correct to the best of my knowledge.
                                             I understand that any false statement or misrepresentation may result in the revocation of my TESDA
                                             accreditation or disqualification from training and assessment activities.
                                        </p>

                                        <label class="mt-4 flex items-start gap-3 cursor-pointer group">
                                             <input type="checkbox" name="agreedToTerms" value="1"
                                                  {{ old('agreedToTerms', $learner->agreed_to_terms) ? 'checked' : '' }}
                                                  class="mt-0.5 h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500 cursor-pointer">
                                             <span class="text-xs leading-relaxed text-gray-600 transition-colors group-hover:text-gray-800 dark:text-gray-300">
                                                  I have read, understood, and agree to the above certification statement and
                                                  <a href="{{ route('data.privacy') }}" class="text-blue-500 underline">data privacy</a>
                                                  <span class="ml-0.5 text-red-500">*</span>
                                             </span>
                                        </label>

                                        @error('agreedToTerms')
                                        <p class="mt-2 flex items-center gap-1 text-xs text-red-600">
                                             <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                             </svg>
                                             {{ $message }}
                                        </p>
                                        @enderror
                                   </div>
                              </div>
                         </div>
                    </div>

                    {{-- Footer --}}
                    <div class="flex flex-col gap-3 border-t border-gray-100 bg-gray-50 px-6 py-5 dark:border-gray-800 dark:bg-gray-900/70 sm:flex-row sm:items-center sm:justify-between">
                         <p class="text-xs text-gray-500 dark:text-gray-400">
                              Review all learner information carefully before saving changes.
                         </p>

                         <div class="flex items-center gap-3">
                              <button type="submit"
                                   class="inline-flex items-center gap-2 rounded-2xl bg-blue-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                                   <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                   </svg>
                                   Update Student Profile Details
                              </button>
                         </div>
                    </div>
               </form>
          </div>
     </div>

     <script>
          let workExpCount = parseInt(document.getElementById('work-experiences-container').dataset.count);
          let trainingCount = parseInt(document.getElementById('trainings-container').dataset.count);
          let licensureCount = parseInt(document.getElementById('licensure-container').dataset.count);
          let competencyCount = parseInt(document.getElementById('competency-container').dataset.count);
          let documentCount = parseInt(document.getElementById('documents-container').dataset.count);

          const removeIconSvg = `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>`;

          function removeEmptyNotice(containerId) {
               const container = document.getElementById(containerId);
               const notice = container.querySelector('.empty-notice');
               if (notice) notice.remove();
          }

          function addEmptyNoticeIfEmpty(containerId, itemSelector, label) {
               const container = document.getElementById(containerId);
               if (container.querySelectorAll(itemSelector).length === 0) {
                    const p = document.createElement('p');
                    p.className = 'py-4 text-center text-sm text-gray-500 empty-notice';
                    p.textContent = `No ${label.toLowerCase()} added yet.`;
                    container.appendChild(p);
               }
          }

          function renumberItems(containerId, itemSelector) {
               const container = document.getElementById(containerId);
               container.querySelectorAll(itemSelector).forEach((el, i) => {
                    const num = el.querySelector('.item-number');
                    if (num) num.textContent = i + 1;
               });
          }

          function reindexInputs(containerId, itemSelector) {
               const container = document.getElementById(containerId);
               container.querySelectorAll(itemSelector).forEach((el, i) => {
                    el.querySelectorAll('[name]').forEach(input => {
                         input.name = input.name.replace(/\[\d+\]/, `[${i}]`);
                    });
               });
          }

          function removeItem(btn, containerId, itemSelector, label) {
               if (!confirm(`Remove this ${label}?`)) return;
               btn.closest(itemSelector).remove();
               renumberItems(containerId, itemSelector);
               addEmptyNoticeIfEmpty(containerId, itemSelector, label);
               reindexInputs(containerId, itemSelector);
          }

          function previewPicture(input) {
               if (!input.files || !input.files[0]) return;
               const reader = new FileReader();
               reader.onload = e => {
                    const preview = document.getElementById('picture-preview');
                    const img = document.getElementById('picture-preview-img');
                    const label = document.getElementById('picture-preview-label');
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                    label.textContent = 'New photo selected';
                    label.classList.remove('hidden');
                    preview.classList.remove('hidden');
               };
               reader.readAsDataURL(input.files[0]);
          }

          function addWorkExperience() {
               removeEmptyNotice('work-experiences-container');
               const i = workExpCount++;
               const html = `
            <div class="work-experience-item rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/60">
                <div class="mb-3 flex items-center justify-between">
                    <h4 class="font-medium text-gray-900 dark:text-white">Work Experience #<span class="item-number">${document.querySelectorAll('.work-experience-item').length + 1}</span></h4>
                    <button type="button" onclick="removeItem(this,'work-experiences-container','.work-experience-item','Work Experience')" class="text-red-600 hover:text-red-800">${removeIconSvg}</button>
                </div>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <input type="text" name="work_experiences[${i}][company]" placeholder="Company Name" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                    <input type="text" name="work_experiences[${i}][position]" placeholder="Position" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                    <input type="text" name="work_experiences[${i}][duration]" placeholder="Duration (e.g., 2020-2023)" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                    <textarea name="work_experiences[${i}][responsibilities]" placeholder="Responsibilities" rows="2" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm"></textarea>
                </div>
            </div>`;
               document.getElementById('work-experiences-container').insertAdjacentHTML('beforeend', html);
          }

          function addTraining() {
               removeEmptyNotice('trainings-container');
               const i = trainingCount++;
               const html = `
            <div class="training-item rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/60">
                <div class="mb-3 flex items-center justify-between">
                    <h4 class="font-medium text-gray-900 dark:text-white">Training #<span class="item-number">${document.querySelectorAll('.training-item').length + 1}</span></h4>
                    <button type="button" onclick="removeItem(this,'trainings-container','.training-item','Training')" class="text-red-600 hover:text-red-800">${removeIconSvg}</button>
                </div>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <input type="text" name="trainings[${i}][title]" placeholder="Training Title" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                    <input type="text" name="trainings[${i}][provider]" placeholder="Training Provider" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                    <input type="text" name="trainings[${i}][date]" placeholder="Date (e.g., January 2023)" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                    <input type="text" name="trainings[${i}][hours]" placeholder="Number of Hours" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                </div>
            </div>`;
               document.getElementById('trainings-container').insertAdjacentHTML('beforeend', html);
          }

          function addLicensure() {
               removeEmptyNotice('licensure-container');
               const i = licensureCount++;
               const html = `
            <div class="licensure-item rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/60">
                <div class="mb-3 flex items-center justify-between">
                    <h4 class="font-medium text-gray-900 dark:text-white">Licensure #<span class="item-number">${document.querySelectorAll('.licensure-item').length + 1}</span></h4>
                    <button type="button" onclick="removeItem(this,'licensure-container','.licensure-item','Licensure')" class="text-red-600 hover:text-red-800">${removeIconSvg}</button>
                </div>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <input type="text" name="licensure_examination[${i}][title]" placeholder="Examination Title" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                    <input type="text" name="licensure_examination[${i}][license_number]" placeholder="License Number" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                    <input type="text" name="licensure_examination[${i}][date_taken]" placeholder="Date Taken" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                    <input type="text" name="licensure_examination[${i}][validity]" placeholder="Validity Period" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                </div>
            </div>`;
               document.getElementById('licensure-container').insertAdjacentHTML('beforeend', html);
          }

          function addCompetency() {
               removeEmptyNotice('competency-container');
               const i = competencyCount++;
               const html = `
            <div class="competency-item rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/60">
                <div class="mb-3 flex items-center justify-between">
                    <h4 class="font-medium text-gray-900 dark:text-white">Assessment #<span class="item-number">${document.querySelectorAll('.competency-item').length + 1}</span></h4>
                    <button type="button" onclick="removeItem(this,'competency-container','.competency-item','Assessment')" class="text-red-600 hover:text-red-800">${removeIconSvg}</button>
                </div>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <input type="text" name="competency_assessment[${i}][qualification]" placeholder="Qualification Title" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                    <input type="text" name="competency_assessment[${i}][certificate_number]" placeholder="Certificate Number" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                    <input type="text" name="competency_assessment[${i}][date_issued]" placeholder="Date Issued" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                    <input type="text" name="competency_assessment[${i}][expiry_date]" placeholder="Expiry Date" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                </div>
            </div>`;
               document.getElementById('competency-container').insertAdjacentHTML('beforeend', html);
          }

          const documentTypeOptions = `
            <option value="">Select document type</option>
            @foreach(\App\Enums\DocumentTypeEnum::cases() as $type)
                <option value="{{ $type->value }}">{{ str_replace('_', ' ', $type->name) }}</option>
            @endforeach
        `;

          function addDocument() {
               removeEmptyNotice('documents-container');
               const i = documentCount++;
               const num = document.querySelectorAll('.document-item').length + 1;
               const html = `
            <div class="document-item rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/60" data-doc-id="">
                <div class="mb-3 flex items-center justify-between">
                    <h4 class="font-medium text-gray-900 dark:text-white">Document #<span class="item-number">${num}</span></h4>
                    <button type="button" onclick="removeDocument(this)" class="text-red-600 hover:text-red-800">${removeIconSvg}</button>
                </div>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <select name="documents[${i}][type]" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                        ${documentTypeOptions}
                    </select>
                    <input type="file" name="documents[${i}][file]" class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm">
                </div>
            </div>`;
               document.getElementById('documents-container').insertAdjacentHTML('beforeend', html);
          }

          function removeDocument(btn) {
               if (!confirm('Are you sure you want to remove this document? This will permanently delete the file and cannot be undone.')) return;

               const item = btn.closest('.document-item');
               const docId = item.dataset.docId;

               if (docId) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'deleted_document_ids[]';
                    input.value = docId;
                    document.getElementById('deleted-document-ids-container').appendChild(input);
               }

               item.remove();
               renumberItems('documents-container', '.document-item');
               addEmptyNoticeIfEmpty('documents-container', '.document-item', 'Documents');
               reindexInputs('documents-container', '.document-item');
          }
     </script>
</x-layouts.app.flowbite>