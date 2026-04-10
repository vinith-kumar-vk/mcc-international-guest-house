<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form - MCC IGH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        .page-header-banner {
            background: #ffffff;
            padding: 2.5rem 1rem 4rem 1rem;
            text-align: center;
            border-bottom: 1px solid #eaedf0;
        }

        .form-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            padding: 1.25rem 2.25rem;
            /* Compact padding */
            width: 100%;
            position: relative;
            z-index: 5;
            border: 1px solid rgba(0, 0, 0, 0.04);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            animation: fadeInUp 0.5s ease-out forwards;
        }

        .form-container:hover {
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            /* 2 equal columns */
            gap: 20px;
            /* Perfect 20px spacing */
            align-items: end;
            /* CRITICAL FIX: Base-aligns all inputs flawlessly to the exact same horizontal baseline irrespective of label wrapping above them */
        }


        .form-group {
            display: flex;
            flex-direction: column;
            position: relative;
            justify-content: flex-end;
            height: 100%;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .paired-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            align-items: end;
            grid-column: 1 / -1;
            /* Forces row to span full width securely isolating inside grids */
            width: 100%;
        }


        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.4rem;
            display: block;
            min-height: 1.1rem;
        }

        .form-label span {
            color: #e53e3e;
            margin-left: 2px;
        }

        .form-helper {
            font-size: 0.8rem;
            color: #64748b;
            font-weight: 500;
            margin-top: 0.3rem;
            display: block;
            min-height: 1rem;
        }

        .form-input,
        .form-select,
        input.form-input,
        select.form-select {
            height: 44px;
            /* Perfect normalized 44px field height */
            padding: 0 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: #ffffff;
            width: 100%;
            box-sizing: border-box;
            color: #333333 !important;
            opacity: 1 !important;
            -webkit-text-fill-color: #333333 !important;
            font-weight: 500 !important;
        }

        .form-input::placeholder {
            color: #9ca3af !important;
            font-weight: 400 !important;
            -webkit-text-fill-color: #9ca3af !important;
            opacity: 1 !important;
        }

        .form-input:hover,
        .form-select:hover {
            border-color: #cbd5e1;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--primary-color);
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(255, 122, 0, 0.15);
            /* Clean orange glow */
        }

        .form-radio-group {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            padding: 0.3rem 0;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
            cursor: pointer;
            color: var(--text-color);
            font-weight: 500;
        }

        .radio-label input[type="radio"] {
            accent-color: var(--primary-color);
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .breadcrumb {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 0.75rem;
            font-weight: 500;
        }

        .breadcrumb a {
            color: var(--primary-color);
            text-decoration: none;
            transition: 0.2s;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
            color: #cc4800;
        }

        .submit-btn {
            background: var(--primary-color) !important;
            color: #ffffff !important;
            border: none !important;
            padding: 1.1rem 2rem !important;
            font-size: 1rem !important;
            font-weight: 700 !important;
            border-radius: 8px !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 10px !important;
            width: 100% !important;
            margin-top: 2rem !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            font-family: 'Inter', sans-serif !important;
        }

        .submit-btn:hover {
            background: var(--primary-color) !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
            color: #ffffff !important;
            transform: translateY(-1px) !important;
        }

        .submit-btn:active {
            transform: translateY(0) !important;
        }

        .btn {
            background: var(--primary-color) !important;
            color: #ffffff !important;
            border: none !important;
            padding: 0.9rem 1.6rem !important;
            font-size: 0.95rem !important;
            font-weight: 800 !important;
            border-radius: 12px !important;
            cursor: pointer !important;
            transition: background 0.2s ease, box-shadow 0.2s ease !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            text-decoration: none !important;
            box-shadow: 0 4px 12px rgba(255, 122, 0, 0.25) !important;
            text-transform: uppercase !important;
            letter-spacing: 0.8px !important;
            opacity: 1 !important;
            transform: none !important;
        }

        .btn:hover {
            background: var(--primary-color) !important;
            box-shadow: 0 6px 20px rgba(255, 122, 0, 0.35) !important;
            color: #ffffff !important;
            transform: none !important;
            padding: 0.9rem 1.6rem !important;
        }

        .btn-outline {
            background: transparent !important;
            color: var(--primary-color) !important;
            border: 2px solid var(--primary-color) !important;
            box-shadow: none !important;
            transform: none !important;
        }

        .btn-outline:hover {
            background: var(--primary-color) !important;
            color: #ffffff !important;
            transform: none !important;
        }

        .form-section-title {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--primary-color);
            padding-bottom: 0.5rem;
            border-bottom: 2px solid rgba(255, 122, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: 0.75rem;
            margin-bottom: 0.75rem;
            letter-spacing: -0.2px;
        }

        .form-section-title i {
            font-size: 1.4rem;
            flex-shrink: 0;
            color: var(--primary-color);
        }

        .section-divider {
            display: none;
        }

        .dynamic-field {
            display: none;
        }

        .dynamic-field.show {
            display: flex;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .summary-banner {
            background: rgba(255, 122, 0, 0.04);
            border: 1px solid rgba(255, 122, 0, 0.15);
            border-radius: 8px;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .summary-banner h3 {
            color: var(--text-color);
            font-size: 1.15rem;
            font-weight: 700;
            margin: 0;
        }

        .summary-banner p {
            color: var(--text-light);
            font-size: 0.9rem;
            margin: 0;
            margin-top: 5px;
        }

        /* ── RESPONSIVE FIXES ── */
        @media (max-width: 768px) {
            .form-grid, .paired-row {
                grid-template-columns: 1fr !important;
                gap: 20px !important;
                align-items: start !important;
            }
            .form-group {
                margin-top: 0 !important;
            }
            .dynamic-field {
                margin-top: 0 !important;
            }
            #otherDepartmentWrapper {
                margin-top: 5px !important;
            }
            .form-container {
                padding: 1.5rem 1.25rem !important;
            }
            .form-section-title {
                font-size: 1.1rem !important;
                margin-top: 1.5rem !important;
            }
            .submit-btn {
                padding: 1rem !important;
                font-size: 0.95rem !important;
            }
            .form-radio-group {
                gap: 1rem !important;
                flex-wrap: wrap;
            }
            .form-label {
                font-size: 0.85rem !important;
            }
            .form-helper {
                font-size: 0.75rem !important;
                line-height: 1.3 !important;
            }
        }
    </style>
    @include('partials.dynamic-styles')
</head>

<body style="background: var(--bg-color);">
    @include('partials.header', ['headerBackBtn' => ['url' => route('home'), 'label' => 'Dashboard']])

    <main>
        <div style="max-width: 820px; margin: 1rem auto;">

            <!-- Breadcrumbs ALIGNED EXACTLY WITH HEADER & FORM -->
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Dashboard</a> &gt;
                <a href="{{ route('standard.rooms') }}">Rooms</a> &gt;
                <span style="color: var(--text-color);">Booking Form</span>
            </div>

            <!-- Page Header Aligned Correctly -->
            <div style="margin-bottom: 1rem; animation: fadeInDown 0.4s ease-out;">
                <h2
                    style="font-size: 2rem; color: var(--text-color); font-weight: 800; letter-spacing: -1px; margin-bottom: 0.15rem;">
                    IGH Booking</h2>
                <p style="color: var(--text-light); font-size: 0.95rem; font-weight: 500; margin: 0;">Secure your
                    accommodation efficiently for <strong style="color: var(--primary-color);">
                        {{ str_replace('-', ' ', ucwords($roomId, '- ')) }}</strong></p>
            </div>

            <div class="form-container">
                <div class="summary-banner">
                    <div>
                        <h3>Selected: {{ str_replace('-', ' ', ucwords($roomId, '- ')) }}</h3>
                        <p>Enjoy premium amenities and professional hospitality</p>
                    </div>
                </div>

                @if($errors->any())
                <div style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                    <ul style="margin: 0; padding-left: 1.5rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session('error'))
                <div style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                    {{ session('error') }}
                </div>
                @endif

                <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="room_name" value="{{ $roomId }}">

                    <div class="form-grid">

                        <!-- SECTION: PROFILE DETAILS -->
                        <div class="form-section-title full-width"><i class="ph-bold ph-identification-card"></i>
                            Personal Details</div>

                        <!-- Nationality -->
                        <div class="form-group full-width" style="margin-bottom: 0.75rem;">
                            <label class="form-label">Nationality <span>*</span></label>
                            <div class="form-radio-group">
                                <label class="radio-label"><input type="radio" name="nationality" value="Indian"
                                        onchange="toggleNationalityFields()" checked> Indian</label>
                                <label class="radio-label"><input type="radio" name="nationality" value="Non-Indian"
                                        onchange="toggleNationalityFields()"> Non-Indian</label>
                            </div>
                        </div>

                        <!-- ISOLATED ROW 1: User Type (Left) | Applicant Name (Right) -->
                        <div class="paired-row">
                            <!-- User Type -->
                            <div class="form-group">
                                <label class="form-label">User Type <span>*</span></label>
                                <select class="form-select" id="userTypeSelect" name="user_type"
                                    onchange="toggleStudentFields()" required>
                                    <option value="" disabled selected>Select Current Status</option>
                                    <option value="Student">Student</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Alumni">Alumni</option>
                                </select>
                                <div class="form-helper">Your formal association with the institution</div>
                            </div>

                            <!-- Name -->
                            <div class="form-group">
                                <label class="form-label">Applicant Name <span>*</span></label>
                                <input type="text" name="name" class="form-input"
                                    placeholder="Your full name as per official ID" value="{{ old('name') }}" required>
                                <div class="form-helper" style="visibility: hidden;">Placeholder helper</div>
                            </div>
                        </div>

                        <div class="form-group dynamic-field student-field full-width" id="streamFieldGroup">
                            <label class="form-label">Stream <span>*</span></label>
                            <div class="form-radio-group">
                                <label class="radio-label"><input type="radio" name="stream" value="Aided"
                                        onchange="updateDepartments('Aided')"> Aided</label>
                                <label class="radio-label"><input type="radio" name="stream" value="SFS"
                                        onchange="updateDepartments('SFS')"> SFS</label>
                            </div>
                            <div class="form-helper">Select academic stream</div>
                        </div>

                        <div class="form-group dynamic-field student-field" id="levelFieldGroup">
                            <label class="form-label">Level <span>*</span></label>
                            <select class="form-select" name="level">
                                <option value="" disabled selected>Select Degree Level</option>
                                <option value="UG">Undergraduate (UG)</option>
                                <option value="PG">Postgraduate (PG)</option>
                                <option value="MPhil">Master of Philosophy (MPhil)</option>
                                <option value="PhD">Doctorate (PhD)</option>
                            </select>
                        </div>

                        <div class="form-group dynamic-field student-field full-width" id="departmentFieldGroup">
                            <label class="form-label">Department <span>*</span></label>
                            <select class="form-select" id="departmentSelect" name="department"
                                onchange="toggleOtherDepartment()">
                                <option value="" disabled selected>Select Stream First</option>
                            </select>

                            <!-- Hidden Smooth "Other" Field -->
                            <div id="otherDepartmentWrapper"
                                style="overflow: hidden; max-height: 0; display: none; margin-top: 0.5rem;">
                                <input type="text" class="form-input" id="otherDepartmentInput" name="department_other"
                                    placeholder="Enter Department Name" style="border-color: var(--primary-color);">
                            </div>
                        </div>

                        <!-- SECTION: CONTACT & GUEST -->
                        <!-- SECTION: CONTACT DETAILS -->
                        <div class="section-divider"></div>
                        <div class="form-section-title full-width"><i class="ph-bold ph-address-book"></i> Contact
                            Details</div>

                        <!-- ISOLATED ROW 2: Email (Left) | Contact (Right) -->
                        <div class="paired-row">
                            <!-- Email -->
                            <div class="form-group">
                                <label class="form-label">Email Address <span>*</span></label>
                                <input type="email" name="email" class="form-input" placeholder="you@domain.edu"
                                    value="{{ old('email') }}" required>
                                <div class="form-helper">Enter valid email for confirmation</div>
                            </div>

                            <!-- Contact -->
                            <div class="form-group">
                                <label class="form-label">Contact Number <span>*</span></label>
                                <input type="tel" name="phone" class="form-input" placeholder="+91 xxxxx xxxxx"
                                    value="{{ old('phone') }}" required>
                                <div class="form-helper">For booking updates</div>
                            </div>
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label">Primary Guest Name</label>
                            <input type="text" name="primary_guest_name" class="form-input"
                                placeholder="Guest full name (Leave blank if self)">
                            <div class="form-helper">Enter the name of the guest staying if different from applicant
                            </div>
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label">Number of Persons <span>*</span></label>
                            <input type="number" name="no_of_persons" min="1" max="4" class="form-input"
                                placeholder="e.g. 2" required>
                        </div>

                        <!-- DYNAMIC: Non-Indian Fields -->
                        <div class="form-group dynamic-field non-indian-field full-width" id="passportFieldGroup"
                            style="grid-column: 1/-1;">
                            <label class="form-label">Passport Number <span>*</span></label>
                            <input type="text" name="passport_number" class="form-input"
                                placeholder="Required for Non-Indian guests" id="passportInput">
                        </div>

                        <div class="form-group dynamic-field non-indian-field full-width" id="gstFieldGroup"
                            style="grid-column: 1/-1;">
                            <label class="form-label">GST Number</label>
                            <input type="text" name="gst_id" class="form-input"
                                placeholder="If applicable for corporate booking (Optional)">
                        </div>

                        <!-- SECTION: STAY DETAILS -->
                        <div class="section-divider"></div>
                        <div class="form-section-title full-width" style="margin-top: 0.75rem;"><i
                                class="ph-bold ph-calendar-check" style="color: var(--primary-color);"></i> Booking
                            Details</div>
                        <p class="gst-text" style="margin-bottom: 0.75rem;">+ 5% GST applicable on all room rates</p>

                        <!-- ISOLATED ROW 5: Clock In (Left) | Clock Out (Right) -->
                        <div class="paired-row">
                            <div class="form-group">
                                <label class="form-label">Clock In Date & Time <span>*</span></label>
                                <input type="datetime-local" name="clock_in" class="form-input" value="{{ old('clock_in') }}" required>
                                <div class="form-helper">Select your intended arrival</div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Clock Out Date & Time <span>*</span></label>
                                <input type="datetime-local" name="clock_out" class="form-input" value="{{ old('clock_out') }}" required>
                                <div class="form-helper">Select your intended departure</div>
                            </div>
                        </div>

                        <!-- Referral Attachment -->
                        <div class="form-group full-width" style="margin-top: 0.5rem;">
                            <label class="form-label">Referral Attachment</label>
                            <input type="file" name="referral_attachment" class="form-input" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <div class="form-helper">Upload a referral document if applicable (PDF, Image, etc.)</div>
                        </div>

                        <!-- Submit -->
                        <div class="form-group full-width" style="margin-top: 1rem;">
                            <button type="submit" class="submit-btn confirm-booking-btn">CONFIRM BOOKING <i class="ph-bold ph-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div><!-- /.form-container -->
        </div>
    </main>
    @include('partials.footer')

    <script>
        function toggleStudentFields() {
            const userType = document.getElementById('userTypeSelect').value;
            const studentFields = document.querySelectorAll('.student-field');

            studentFields.forEach(field => {
                if (userType === 'Student') {
                    field.classList.add('show');
                    // Add required securely to dynamic inputs, explicitly excluding "Other" handler
                    const inputs = field.querySelectorAll('input:not(#otherDepartmentInput), select');
                    inputs.forEach(input => input.setAttribute('required', 'true'));
                } else {
                    field.classList.remove('show');
                    // Remove required
                    const inputs = field.querySelectorAll('input, select');
                    inputs.forEach(input => input.removeAttribute('required'));
                }
            });

            // Refresh Other Dept logic on toggle
            if (userType === 'Student') toggleOtherDepartment();
        }

        const aidedDepartments = [
            "English", "Tamil", "Languages", "History", "Political Science",
            "Public Administration", "Economics", "Philosophy", "Commerce",
            "Social Work", "Mathematics", "Statistics", "Physics", "Chemistry",
            "Botany", "Zoology", "Physical Education"
        ];

        const sfsDepartments = [
            "English", "Tamil", "Languages", "Journalism", "Social Work",
            "Commerce", "Business Administration", "Communication", "Geography",
            "Tourism Studies", "Mathematics", "Physics", "Chemistry", "Microbiology",
            "Computer Application (BCA)", "Computer Science (B.Sc)",
            "Computer Science (MCA)", "Visual Communication",
            "Physical Education, Health Education and Sports", "Psychology", "Data Science"
        ];

        function updateDepartments(stream) {
            const deptSelect = document.getElementById('departmentSelect');

            // Clean slate -> Resets selection smoothly on change
            deptSelect.innerHTML = '<option value="" disabled selected>Select Department</option>';

            let options = stream === 'Aided' ? aidedDepartments : sfsDepartments;

            options.forEach(dept => {
                let opt = document.createElement('option');
                opt.value = dept;
                opt.innerHTML = dept;
                deptSelect.appendChild(opt);
            });

            // Attach "Other"
            let otherOpt = document.createElement('option');
            otherOpt.value = 'Other';
            otherOpt.innerHTML = 'Other';
            deptSelect.appendChild(otherOpt);

            // Trigger cleanly
            toggleOtherDepartment();
        }

        function toggleOtherDepartment() {
            const deptSelect = document.getElementById('departmentSelect');
            const otherWrapper = document.getElementById('otherDepartmentWrapper');
            const otherInput = document.getElementById('otherDepartmentInput');
            const isStudent = document.getElementById('userTypeSelect').value === 'Student';

            if (deptSelect.value === 'Other' && isStudent) {
                otherWrapper.style.display = 'block';
                otherWrapper.style.maxHeight = '100px';
                otherInput.setAttribute('required', 'true');
            } else {
                otherWrapper.style.display = 'none';
                otherWrapper.style.maxHeight = '0';
                otherInput.removeAttribute('required');
            }
        }

        // ISSUE 2: Date selection allows past dates
        document.addEventListener('DOMContentLoaded', function () {
            const now = new Date();
            const today = now.toISOString().split('T')[0];
            const todayDateTime = now.toISOString().slice(0, 16);

            document.querySelectorAll('input[type="date"]').forEach(input => {
                input.setAttribute('min', today);
            });

            document.querySelectorAll('input[type="datetime-local"]').forEach(input => {
                input.setAttribute('min', todayDateTime);
            });
        });

        function toggleNationalityFields() {
            const isNonIndian = document.querySelector('input[name="nationality"][value="Non-Indian"]').checked;
            const nonIndianFields = document.querySelectorAll('.non-indian-field');
            const passportInput = document.getElementById('passportInput');

            nonIndianFields.forEach(field => {
                if (isNonIndian) {
                    field.classList.add('show');
                } else {
                    field.classList.remove('show');
                }
            });

            if (isNonIndian) {
                passportInput.setAttribute('required', 'true');
            } else {
                passportInput.removeAttribute('required');
            }
        }

        // Initialize state natively on load to prevent glitch rendering
        document.addEventListener('DOMContentLoaded', () => {
            toggleStudentFields();
            toggleNationalityFields();
        });
    </script>
</body>

</html>