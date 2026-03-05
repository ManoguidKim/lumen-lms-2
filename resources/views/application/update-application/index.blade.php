<x-layouts.app.flowbite>
     <div>
          <div class="max-w-full mx-auto">
               <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">

                    {{-- Header --}}
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200 bg-blue-50 dark:bg-gray-600">
                         <div>
                              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Update Learner Information</h3>
                              <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                   Update the details of
                                   <span class="font-semibold text-gray-800 dark:text-white">
                                        {{ $learner->name }} {{ $learner->last_name }}
                                   </span>
                                   — ULI:
                                   <span class="font-mono text-blue-600 dark:text-blue-300">{{ $learner->uli }}</span>
                              </p>
                         </div>
                    </div>

                    {{-- Flash Messages --}}
                    @if(session('success'))
                    <div class="m-4 md:m-5 p-4 text-green-800 bg-green-50 rounded-lg" role="alert">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                    <div class="m-4 md:m-5 p-4 text-red-800 bg-red-50 rounded-lg" role="alert">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('update-registered-learner.update', $learner->uuid) }}" method="POST" enctype="multipart/form-data">
                         @csrf
                         @method('PUT')

                         {{-- Hidden container: collects IDs of documents removed from DOM --}}
                         <div id="deleted-document-ids-container"></div>

                         {{-- ULI --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200 animate__pulse">
                              <h2 class="text-lg font-semibold text-gray-900 mb-4">Unique Learner Identifier</h2>
                              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">
                                             Unique Learner Identifier <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="uli" value="{{ old('uli', $learner->uli) }}" autocomplete="off"
                                             class="bg-gray-50 border @error('uli') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Enter unique learner identifier">
                                        @error('uli')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                              </div>
                         </div>

                         {{-- Basic Information --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>
                              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">First Name <span class="text-red-500">*</span></label>
                                        <input type="text" name="firstName" value="{{ old('firstName', $learner->name) }}" autocomplete="off"
                                             class="bg-gray-50 border @error('firstName') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Enter first name">
                                        @error('firstName')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Middle Name</label>
                                        <input type="text" name="middleName" value="{{ old('middleName', $learner->middle_name) }}" autocomplete="off"
                                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Enter middle name">
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Last Name <span class="text-red-500">*</span></label>
                                        <input type="text" name="lastName" value="{{ old('lastName', $learner->last_name) }}" autocomplete="off"
                                             class="bg-gray-50 border @error('lastName') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Enter last name">
                                        @error('lastName')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Suffix</label>
                                        <input type="text" name="suffix" value="{{ old('suffix', $learner->extension) }}" maxlength="10" autocomplete="off"
                                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Jr., Sr., III, etc.">
                                   </div>
                              </div>
                         </div>

                         {{-- Other Information --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <h2 class="text-lg font-semibold text-gray-900 mb-4">Other Information</h2>
                              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Client Type</label>
                                        <select name="clientType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <option value="">Select client type</option>
                                             <option value="tvet_graduating_student" @selected(old('clientType', $learner->client_type) === 'tvet_graduating_student')>TVET Graduating Student</option>
                                             <option value="tvet_graduate" @selected(old('clientType', $learner->client_type) === 'tvet_graduate')>TVET Graduate</option>
                                             <option value="industry_worker" @selected(old('clientType', $learner->client_type) === 'industry_worker')>Industry Worker</option>
                                             <option value="k12" @selected(old('clientType', $learner->client_type) === 'k12')>K12</option>
                                             <option value="owf" @selected(old('clientType', $learner->client_type) === 'owf')>OWF</option>
                                        </select>
                                        @error('clientType')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>

                                   <div class="md:col-span-3">
                                        <label for="picture" class="block mb-2 text-sm font-medium text-gray-900">Profile Picture</label>
                                        <input type="file" id="picture" name="picture" accept="image/*"
                                             class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                             onchange="previewPicture(this)">

                                        {{-- Current picture from S3 --}}
                                        @if($learner->picture_path)
                                        <div id="current-picture" class="mt-2 flex items-center gap-3">
                                             <img src="{{ Storage::disk('s3')->temporaryUrl($learner->picture_path, now()->addMinutes(5)) }}"
                                                  class="h-20 w-20 object-cover rounded-lg border">
                                             <p class="text-xs text-gray-500">Current picture — upload a new one to replace</p>
                                        </div>
                                        @endif

                                        {{-- Preview of newly selected picture --}}
                                        <div id="picture-preview" class="mt-2 hidden">
                                             <img id="picture-preview-img" src="" class="h-20 w-20 object-cover rounded-lg border">
                                             <p class="text-xs text-gray-500 mt-1">New photo selected (not yet saved)</p>
                                        </div>

                                        @error('picture')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                              </div>
                         </div>

                         {{-- School Information --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <h2 class="text-lg font-semibold text-gray-900 mb-4">School Information</h2>
                              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">School Name</label>
                                        <input type="text" name="schoolName" value="{{ old('schoolName', $learner->school_name) }}" autocomplete="off"
                                             class="bg-gray-50 border @error('schoolName') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="e.g. XYZ Technical School">
                                        @error('schoolName')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">School Address</label>
                                        <textarea name="schoolAddress" rows="1" autocomplete="off"
                                             class="bg-gray-50 border @error('schoolAddress') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Complete school address">{{ old('schoolAddress', $learner->school_address) }}</textarea>
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
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Sex <span class="text-red-500">*</span></label>
                                        <select name="sex" class="bg-gray-50 border @error('sex') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <option value="">Select sex</option>
                                             <option value="male" @selected(old('sex', $learner->sex) === 'male')>Male</option>
                                             <option value="female" @selected(old('sex', $learner->sex) === 'female')>Female</option>
                                        </select>
                                        @error('sex')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Civil Status <span class="text-red-500">*</span></label>
                                        <select name="civilStatus" class="bg-gray-50 border @error('civilStatus') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <option value="">Select civil status</option>
                                             <option value="single" @selected(old('civilStatus', $learner->civil_status) === 'single')>Single</option>
                                             <option value="married" @selected(old('civilStatus', $learner->civil_status) === 'married')>Married</option>
                                             <option value="widow" @selected(old('civilStatus', $learner->civil_status) === 'widow')>Widow</option>
                                             <option value="separated" @selected(old('civilStatus', $learner->civil_status) === 'separated')>Separated</option>
                                        </select>
                                        @error('civilStatus')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Date of Birth <span class="text-red-500">*</span></label>
                                        <input type="date" name="birthDate" value="{{ old('birthDate', $learner->birth_date) }}"
                                             class="bg-gray-50 border @error('birthDate') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        @error('birthDate')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Place of Birth</label>
                                        <input type="text" name="birthPlace" value="{{ old('birthPlace', $learner->birth_place) }}" autocomplete="off"
                                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="City/Municipality, Province">
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Mother's Name</label>
                                        <input type="text" name="motherName" value="{{ old('motherName', $learner->mother_name) }}" autocomplete="off"
                                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Full name">
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Father's Name</label>
                                        <input type="text" name="fatherName" value="{{ old('fatherName', $learner->father_name) }}" autocomplete="off"
                                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Full name">
                                   </div>
                              </div>
                         </div>

                         {{-- Address Information --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <h2 class="text-lg font-semibold text-gray-900 mb-4">Address Information</h2>
                              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                   <div class="md:col-span-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900">House/Block/Lot No., Street</label>
                                        <input type="text" name="addressNumberStreet" value="{{ old('addressNumberStreet', $learner->address_number_street) }}" autocomplete="off"
                                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="e.g. Block 5 Lot 12, Main Street">
                                   </div>
                                   <div><label class="block mb-2 text-sm font-medium text-gray-900">Barangay</label><input type="text" name="addressBarangay" value="{{ old('addressBarangay', $learner->address_barangay) }}" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Barangay name"></div>
                                   <div><label class="block mb-2 text-sm font-medium text-gray-900">District</label><input type="text" name="addressDistrict" value="{{ old('addressDistrict', $learner->address_district) }}" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="District"></div>
                                   <div><label class="block mb-2 text-sm font-medium text-gray-900">City/Municipality</label><input type="text" name="addressCity" value="{{ old('addressCity', $learner->address_city) }}" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="City"></div>
                                   <div><label class="block mb-2 text-sm font-medium text-gray-900">Province</label><input type="text" name="addressProvince" value="{{ old('addressProvince', $learner->address_province) }}" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Province"></div>
                                   <div><label class="block mb-2 text-sm font-medium text-gray-900">Region</label><input type="text" name="addressRegion" value="{{ old('addressRegion', $learner->address_region) }}" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Region"></div>
                                   <div><label class="block mb-2 text-sm font-medium text-gray-900">ZIP Code</label><input type="text" name="addressZipCode" value="{{ old('addressZipCode', $learner->address_zip_code) }}" maxlength="10" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="ZIP Code"></div>
                              </div>
                         </div>

                         {{-- Contact Information --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <h2 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h2>
                              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Mobile Number <span class="text-red-500">*</span></label>
                                        <input type="tel" name="contactMobile" value="{{ old('contactMobile', $learner->contact_mobile) }}" autocomplete="off"
                                             class="bg-gray-50 border @error('contactMobile') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="e.g. +639123456789">
                                        @error('contactMobile')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div><label class="block mb-2 text-sm font-medium text-gray-900">Telephone</label><input type="tel" name="contactTel" value="{{ old('contactTel', $learner->contact_tel) }}" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g. (02) 1234-5678"></div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Email Address</label>
                                        <input type="email" name="contactEmail" value="{{ old('contactEmail', $learner->contact_email) }}" autocomplete="off"
                                             class="bg-gray-50 border @error('contactEmail') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="email@example.com">
                                        @error('contactEmail')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Fax Number</label>
                                        <input type="tel" name="contactFax" value="{{ old('contactFax', $learner->contact_fax) }}" autocomplete="off"
                                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Fax number">
                                   </div>
                                   <div class="md:col-span-2"><label class="block mb-2 text-sm font-medium text-gray-900">Other Contact Information</label><input type="text" name="contactOthers" value="{{ old('contactOthers', $learner->contact_others) }}" autocomplete="off" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Other contact details"></div>
                              </div>
                         </div>

                         {{-- Educational Background --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <h2 class="text-lg font-semibold text-gray-900 mb-4">Educational Background</h2>
                              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Highest Educational Attainment</label>
                                        <select name="educationalAttainment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <option value="">Select educational attainment</option>
                                             <option value="elementary_graduate" @selected(old('educationalAttainment', $learner->educational_attainment) === 'elementary_graduate')>Elementary Graduate</option>
                                             <option value="high_school_graduate" @selected(old('educationalAttainment', $learner->educational_attainment) === 'high_school_graduate')>High School Graduate</option>
                                             <option value="tvet_graduate" @selected(old('educationalAttainment', $learner->educational_attainment) === 'tvet_graduate')>TVET Graduate</option>
                                             <option value="college_level" @selected(old('educationalAttainment', $learner->educational_attainment) === 'college_level')>College Level</option>
                                             <option value="college_graduate" @selected(old('educationalAttainment', $learner->educational_attainment) === 'college_graduate')>College Graduate</option>
                                             <option value="others" @selected(old('educationalAttainment', $learner->educational_attainment) === 'others')>Others</option>
                                        </select>
                                        @error('educationalAttainment')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                                   </div>
                                   <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">If Others, Please Specify</label>
                                        <input type="text" name="educationalAttainmentOthers" value="{{ old('educationalAttainmentOthers', $learner->educational_attainment_others) }}"
                                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                             placeholder="Specify other educational attainment">
                                   </div>
                              </div>
                         </div>

                         {{-- Employment Information --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <h2 class="text-lg font-semibold text-gray-900 mb-4">Employment Information</h2>
                              <div>
                                   <label class="block mb-2 text-sm font-medium text-gray-900">Employment Status</label>
                                   <select name="employmentStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="">Select employment status</option>
                                        <option value="casual" @selected(old('employmentStatus', $learner->employment_status) === 'casual')>Casual</option>
                                        <option value="job_order" @selected(old('employmentStatus', $learner->employment_status) === 'job_order')>Job Order</option>
                                        <option value="probationary" @selected(old('employmentStatus', $learner->employment_status) === 'probationary')>Probationary</option>
                                        <option value="permanent" @selected(old('employmentStatus', $learner->employment_status) === 'permanent')>Permanent</option>
                                        <option value="self_employed" @selected(old('employmentStatus', $learner->employment_status) === 'self_employed')>Self-Employed</option>
                                        <option value="ofw" @selected(old('employmentStatus', $learner->employment_status) === 'ofw')>OFW</option>
                                   </select>
                                   @error('employmentStatus')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                              </div>
                         </div>

                         {{-- Work Experiences --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <div class="flex items-center justify-between mb-4">
                                   <h2 class="text-lg font-semibold text-gray-900">Work Experiences</h2>
                                   <button type="button" onclick="addWorkExperience()" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">+ Add Work Experience</button>
                              </div>
                              <div id="work-experiences-container" data-count="{{ count($workExperiences) }}" class="space-y-3">
                                   @forelse($workExperiences as $index => $experience)
                                   <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 work-experience-item">
                                        <div class="flex justify-between items-center mb-3">
                                             <h4 class="font-medium text-gray-900">Work Experience #<span class="item-number">{{ $index + 1 }}</span></h4>
                                             <button type="button" onclick="removeItem(this,'work-experiences-container','.work-experience-item','Work Experience')" class="text-red-600 hover:text-red-800">
                                                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                       <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                  </svg>
                                             </button>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                             <input type="text" name="work_experiences[{{ $index }}][company]" value="{{ $experience['company'] ?? '' }}" placeholder="Company Name" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <input type="text" name="work_experiences[{{ $index }}][position]" value="{{ $experience['position'] ?? '' }}" placeholder="Position" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <input type="text" name="work_experiences[{{ $index }}][duration]" value="{{ $experience['duration'] ?? '' }}" placeholder="Duration (e.g., 2020-2023)" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <textarea name="work_experiences[{{ $index }}][responsibilities]" placeholder="Responsibilities" rows="2" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ $experience['responsibilities'] ?? '' }}</textarea>
                                        </div>
                                   </div>
                                   @empty
                                   <p class="text-sm text-gray-500 text-center py-4 empty-notice">No work experiences added yet.</p>
                                   @endforelse
                              </div>
                         </div>

                         {{-- Trainings --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <div class="flex items-center justify-between mb-4">
                                   <h2 class="text-lg font-semibold text-gray-900">Training/Seminars Attended</h2>
                                   <button type="button" onclick="addTraining()" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">+ Add Training</button>
                              </div>
                              <div id="trainings-container" data-count="{{ count($trainings) }}" class="space-y-3">
                                   @forelse($trainings as $index => $training)
                                   <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 training-item">
                                        <div class="flex justify-between items-center mb-3">
                                             <h4 class="font-medium text-gray-900">Training #<span class="item-number">{{ $index + 1 }}</span></h4>
                                             <button type="button" onclick="removeItem(this,'trainings-container','.training-item','Training')" class="text-red-600 hover:text-red-800">
                                                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                       <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                  </svg>
                                             </button>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                             <input type="text" name="trainings[{{ $index }}][title]" value="{{ $training['title'] ?? '' }}" placeholder="Training Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <input type="text" name="trainings[{{ $index }}][provider]" value="{{ $training['provider'] ?? '' }}" placeholder="Training Provider" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <input type="text" name="trainings[{{ $index }}][date]" value="{{ $training['date'] ?? '' }}" placeholder="Date (e.g., January 2023)" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <input type="text" name="trainings[{{ $index }}][hours]" value="{{ $training['hours'] ?? '' }}" placeholder="Number of Hours" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        </div>
                                   </div>
                                   @empty
                                   <p class="text-sm text-gray-500 text-center py-4 empty-notice">No trainings added yet.</p>
                                   @endforelse
                              </div>
                         </div>

                         {{-- Licensure Examinations --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <div class="flex items-center justify-between mb-4">
                                   <h2 class="text-lg font-semibold text-gray-900">Licensure Examinations</h2>
                                   <button type="button" onclick="addLicensure()" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">+ Add Licensure</button>
                              </div>
                              <div id="licensure-container" data-count="{{ count($licensureExamination) }}" class="space-y-3">
                                   @forelse($licensureExamination as $index => $licensure)
                                   <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 licensure-item">
                                        <div class="flex justify-between items-center mb-3">
                                             <h4 class="font-medium text-gray-900">Licensure #<span class="item-number">{{ $index + 1 }}</span></h4>
                                             <button type="button" onclick="removeItem(this,'licensure-container','.licensure-item','Licensure')" class="text-red-600 hover:text-red-800">
                                                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                       <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                  </svg>
                                             </button>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                             <input type="text" name="licensure_examination[{{ $index }}][title]" value="{{ $licensure['title'] ?? '' }}" placeholder="Examination Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <input type="text" name="licensure_examination[{{ $index }}][license_number]" value="{{ $licensure['license_number'] ?? '' }}" placeholder="License Number" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <input type="text" name="licensure_examination[{{ $index }}][date_taken]" value="{{ $licensure['date_taken'] ?? '' }}" placeholder="Date Taken" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <input type="text" name="licensure_examination[{{ $index }}][validity]" value="{{ $licensure['validity'] ?? '' }}" placeholder="Validity Period" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        </div>
                                   </div>
                                   @empty
                                   <p class="text-sm text-gray-500 text-center py-4 empty-notice">No licensure examinations added yet.</p>
                                   @endforelse
                              </div>
                         </div>

                         {{-- Competency Assessments --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <div class="flex items-center justify-between mb-4">
                                   <h2 class="text-lg font-semibold text-gray-900">Competency Assessments</h2>
                                   <button type="button" onclick="addCompetency()" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">+ Add Assessment</button>
                              </div>
                              <div id="competency-container" data-count="{{ count($competencyAssessment) }}" class="space-y-3">
                                   @forelse($competencyAssessment as $index => $competency)
                                   <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 competency-item">
                                        <div class="flex justify-between items-center mb-3">
                                             <h4 class="font-medium text-gray-900">Assessment #<span class="item-number">{{ $index + 1 }}</span></h4>
                                             <button type="button" onclick="removeItem(this,'competency-container','.competency-item','Assessment')" class="text-red-600 hover:text-red-800">
                                                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                       <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                  </svg>
                                             </button>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                             <input type="text" name="competency_assessment[{{ $index }}][qualification]" value="{{ $competency['qualification'] ?? '' }}" placeholder="Qualification Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <input type="text" name="competency_assessment[{{ $index }}][certificate_number]" value="{{ $competency['certificate_number'] ?? '' }}" placeholder="Certificate Number" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <input type="text" name="competency_assessment[{{ $index }}][date_issued]" value="{{ $competency['date_issued'] ?? '' }}" placeholder="Date Issued" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                             <input type="text" name="competency_assessment[{{ $index }}][expiry_date]" value="{{ $competency['expiry_date'] ?? '' }}" placeholder="Expiry Date" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        </div>
                                   </div>
                                   @empty
                                   <p class="text-sm text-gray-500 text-center py-4 empty-notice">No competency assessments added yet.</p>
                                   @endforelse
                              </div>
                         </div>

                         {{-- Documents --}}
                         <div class="p-4 md:p-5 space-y-4 border-b border-gray-200">
                              <div class="flex items-center justify-between mb-4">
                                   <h2 class="text-lg font-semibold text-gray-900">Documents</h2>
                                   <button type="button" onclick="addDocument()" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">+ Add Document</button>
                              </div>
                              <div id="documents-container" data-count="{{ count($documents) }}" class="space-y-3">
                                   @forelse($documents as $index => $document)
                                   <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 document-item" data-doc-id="{{ $document->id }}">
                                        <div class="flex justify-between items-center mb-3">
                                             <h4 class="font-medium text-gray-900">Document #<span class="item-number">{{ $index + 1 }}</span></h4>
                                             <button type="button" onclick="removeDocument(this)" class="text-red-600 hover:text-red-800">
                                                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                       <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                  </svg>
                                             </button>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                             <input type="hidden" name="documents[{{ $index }}][id]" value="{{ $document->id }}">
                                             <select name="documents[{{ $index }}][type]" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                  <option value="">Select document type</option>
                                                  @foreach(\App\Enums\DocumentTypeEnum::cases() as $type)
                                                  <option value="{{ $type->value }}" @selected($document->type === $type->value)>
                                                       {{ str_replace('_', ' ', $type->name) }}
                                                  </option>
                                                  @endforeach
                                             </select>
                                             <input type="file" name="documents[{{ $index }}][file]"
                                                  class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                                             @if($document->file)
                                             <div class="col-span-2 flex items-center gap-2">
                                                  <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                       <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                                                  </svg>
                                                  <a href="{{ Storage::disk('s3')->temporaryUrl($document->file, now()->addMinute(1)) }}"
                                                       target="_blank" class="text-sm text-blue-600 hover:underline truncate">
                                                       {{ basename($document->file) }}
                                                  </a>
                                                  <span class="text-xs text-gray-400">(upload new file to replace)</span>
                                             </div>
                                             @endif
                                        </div>
                                   </div>
                                   @empty
                                   <p class="text-sm text-gray-500 text-center py-4 empty-notice">No documents added yet.</p>
                                   @endforelse
                              </div>
                         </div>

                         {{-- Form Actions --}}
                         <div class="flex flex-wrap items-center gap-3 p-4 md:p-5 border-t border-gray-200 rounded-b">
                              <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center gap-2">
                                   <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                   </svg>
                                   Update learner information
                              </button>
                              <a href="{{ route('learner-training-applications.list.registered.applicants') }}"
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

     <script>
          // ─── Counters from server-rendered items ──────────────────────────────────
          let workExpCount = parseInt(document.getElementById('work-experiences-container').dataset.count);
          let trainingCount = parseInt(document.getElementById('trainings-container').dataset.count);
          let licensureCount = parseInt(document.getElementById('licensure-container').dataset.count);
          let competencyCount = parseInt(document.getElementById('competency-container').dataset.count);
          let documentCount = parseInt(document.getElementById('documents-container').dataset.count);

          const removeIconSvg = `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
               <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
          </svg>`;

          // ─── Shared helpers ───────────────────────────────────────────────────────
          function removeEmptyNotice(containerId) {
               document.getElementById(containerId).querySelector('.empty-notice')?.remove();
          }

          function addEmptyNoticeIfEmpty(containerId, itemSelector, label) {
               const container = document.getElementById(containerId);
               if (container.querySelectorAll(itemSelector).length === 0) {
                    const p = document.createElement('p');
                    p.className = 'text-sm text-gray-500 text-center py-4 empty-notice';
                    p.textContent = `No ${label.toLowerCase()} added yet.`;
                    container.appendChild(p);
               }
          }

          function reindexInputs(containerId, itemSelector) {
               document.getElementById(containerId).querySelectorAll(itemSelector).forEach((el, i) => {
                    el.querySelectorAll('[name]').forEach(input => {
                         input.name = input.name.replace(/\[\d+\]/, `[${i}]`);
                    });
                    const num = el.querySelector('.item-number');
                    if (num) num.textContent = i + 1;
               });
          }

          function removeItem(btn, containerId, itemSelector, label) {
               if (!confirm(`Remove this ${label}?`)) return;
               btn.closest(itemSelector).remove();
               reindexInputs(containerId, itemSelector);
               addEmptyNoticeIfEmpty(containerId, itemSelector, label);
          }

          // ─── Picture preview ──────────────────────────────────────────────────────
          function previewPicture(input) {
               if (!input.files || !input.files[0]) return;
               const reader = new FileReader();
               reader.onload = e => {
                    document.getElementById('picture-preview-img').src = e.target.result;
                    document.getElementById('picture-preview').classList.remove('hidden');
               };
               reader.readAsDataURL(input.files[0]);
          }

          // ─── Work Experiences ─────────────────────────────────────────────────────
          function addWorkExperience() {
               removeEmptyNotice('work-experiences-container');
               const i = workExpCount++;
               const total = document.querySelectorAll('.work-experience-item').length + 1;
               document.getElementById('work-experiences-container').insertAdjacentHTML('beforeend', `
        <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 work-experience-item">
            <div class="flex justify-between items-center mb-3">
                <h4 class="font-medium text-gray-900">Work Experience #<span class="item-number">${total}</span></h4>
                <button type="button" onclick="removeItem(this,'work-experiences-container','.work-experience-item','Work Experience')" class="text-red-600 hover:text-red-800">${removeIconSvg}</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <input type="text" name="work_experiences[${i}][company]" placeholder="Company Name" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <input type="text" name="work_experiences[${i}][position]" placeholder="Position" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <input type="text" name="work_experiences[${i}][duration]" placeholder="Duration (e.g., 2020-2023)" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <textarea name="work_experiences[${i}][responsibilities]" placeholder="Responsibilities" rows="2" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
            </div>
        </div>`);
          }

          // ─── Trainings ────────────────────────────────────────────────────────────
          function addTraining() {
               removeEmptyNotice('trainings-container');
               const i = trainingCount++;
               const total = document.querySelectorAll('.training-item').length + 1;
               document.getElementById('trainings-container').insertAdjacentHTML('beforeend', `
        <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 training-item">
            <div class="flex justify-between items-center mb-3">
                <h4 class="font-medium text-gray-900">Training #<span class="item-number">${total}</span></h4>
                <button type="button" onclick="removeItem(this,'trainings-container','.training-item','Training')" class="text-red-600 hover:text-red-800">${removeIconSvg}</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <input type="text" name="trainings[${i}][title]" placeholder="Training Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <input type="text" name="trainings[${i}][provider]" placeholder="Training Provider" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <input type="text" name="trainings[${i}][date]" placeholder="Date (e.g., January 2023)" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <input type="text" name="trainings[${i}][hours]" placeholder="Number of Hours" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
        </div>`);
          }

          // ─── Licensure ────────────────────────────────────────────────────────────
          function addLicensure() {
               removeEmptyNotice('licensure-container');
               const i = licensureCount++;
               const total = document.querySelectorAll('.licensure-item').length + 1;
               document.getElementById('licensure-container').insertAdjacentHTML('beforeend', `
        <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 licensure-item">
            <div class="flex justify-between items-center mb-3">
                <h4 class="font-medium text-gray-900">Licensure #<span class="item-number">${total}</span></h4>
                <button type="button" onclick="removeItem(this,'licensure-container','.licensure-item','Licensure')" class="text-red-600 hover:text-red-800">${removeIconSvg}</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <input type="text" name="licensure_examination[${i}][title]" placeholder="Examination Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <input type="text" name="licensure_examination[${i}][license_number]" placeholder="License Number" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <input type="text" name="licensure_examination[${i}][date_taken]" placeholder="Date Taken" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <input type="text" name="licensure_examination[${i}][validity]" placeholder="Validity Period" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
        </div>`);
          }

          // ─── Competency ───────────────────────────────────────────────────────────
          function addCompetency() {
               removeEmptyNotice('competency-container');
               const i = competencyCount++;
               const total = document.querySelectorAll('.competency-item').length + 1;
               document.getElementById('competency-container').insertAdjacentHTML('beforeend', `
               <div class="p-4 border border-gray-300 rounded-lg bg-gray-50 competency-item">
                    <div class="flex justify-between items-center mb-3">
                         <h4 class="font-medium text-gray-900">Assessment #<span class="item-number">${total}</span></h4>
                         <button type="button" onclick="removeItem(this,'competency-container','.competency-item','Assessment')" class="text-red-600 hover:text-red-800">${removeIconSvg}</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                         <input type="text" name="competency_assessment[${i}][qualification]" placeholder="Qualification Title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                         <input type="text" name="competency_assessment[${i}][certificate_number]" placeholder="Certificate Number" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                         <input type="text" name="competency_assessment[${i}][date_issued]" placeholder="Date Issued" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                         <input type="text" name="competency_assessment[${i}][expiry_date]" placeholder="Expiry Date" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
               </div>`);
          }

          // ─── Documents ────────────────────────────────────────────────────────────
          const documentTypeOptions = `
               <option value="">Select document type</option>
               @foreach(\App\Enums\DocumentTypeEnum::cases() as $type)
               <option value="{{ $type->value }}">{{ str_replace('_', ' ', $type->name) }}</option>
               @endforeach
          `;

          function addDocument() {
               removeEmptyNotice('documents-container');
               const i = documentCount++;
               const total = document.querySelectorAll('.document-item').length + 1;
               document.getElementById('documents-container').insertAdjacentHTML('beforeend', `
                    <div class="flex justify-between items-center mb-3">
                         <h4 class="font-medium text-gray-900">Document #<span class="item-number">${total}</span></h4>
                         <button type="button" onclick="removeDocument(this)" class="text-red-600 hover:text-red-800">${removeIconSvg}</button>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                         <select name="documents[${i}][type]" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                              ${documentTypeOptions}
                         </select>
                         <input type="file" name="documents[${i}][file]"
                              class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    </div>
               </div>`);
          }

          // ─── Remove document: track DB records for S3 deletion on submit ──────────
          function removeDocument(btn) {
               if (!confirm('Are you sure you want to remove this document? This will permanently delete the file and cannot be undone.')) return;

               const item = btn.closest('.document-item');
               const docId = item.dataset.docId; // only present for existing DB records

               if (docId) {
                    // Queue for S3 + DB deletion in controller on submit
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'deleted_document_ids[]';
                    input.value = docId;
                    document.getElementById('deleted-document-ids-container').appendChild(input);
               }
               // No docId = newly added row, just remove from DOM — nothing to delete server-side

               item.remove();
               reindexInputs('documents-container', '.document-item');
               addEmptyNoticeIfEmpty('documents-container', '.document-item', 'Documents');
          }
     </script>
</x-layouts.app.flowbite>