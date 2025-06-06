@extends('layouts.app')

@section('content')
    <script src="/js/masonry.pkgd.min.js"></script>
    <div class="container">
        <div class="row justify-content-start">
            @include('layouts.left-menu')
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
                <div class="row pt-2">
                    <div class="col ps-4">
                        <h1 class="display-6 mb-3">
                            <i class="bi bi-tools"></i> Academic Settings
                        </h1>

                        @include('session-messages')

                        <div class="mb-4">
                            <div class="row" data-masonry='{"percentPosition": true }'>
                                @if ($latest_school_session_id == $current_school_session_id)
                                    <div class="col-md-4 mb-4">
                                        <div class="p-3 border bg-light shadow-sm">
                                            <h6>Create Session</h6>
                                            <p class="text-danger">
                                                <small><i class="bi bi-exclamation-diamond-fill me-2"></i> Create one
                                                    Session per academic year. Last created session will be considered as
                                                    the latest academic session.</small>
                                            </p>
                                            <form action="https://sim-academy.vercel.app/session/store" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="2021 - 2022" autocomplete="session_name" aria-label="Current Session"
                                                        name="session_name" required>
                                                </div>
                                                <button class="btn btn-sm btn-outline-primary" type="submit"><i
                                                        class="bi bi-check2"></i> Create</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-4 mb-4">
                                    <div class="p-3 border bg-light shadow-sm">
                                        <h6>Browse by Session</h6>
                                        <p class="text-danger">
                                            <small><i class="bi bi-exclamation-diamond-fill me-2"></i> Only use this when
                                                you want to browse data from previous Sessions.</small>
                                        </p>
                                        <form action="https://sim-academy.vercel.app/session/browse" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <p class="mt-2">Select "Session" to browse by:</p>
                                                <select class="form-select form-select-sm" aria-label=".form-select-sm"
                                                    name="session_id" required>
                                                    @isset($school_sessions)
                                                        @foreach ($school_sessions as $school_session)
                                                            <option value="{{ $school_session->id }}">
                                                                {{ $school_session->session_name }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                            <button class="btn btn-sm btn-outline-primary" type="submit"><i
                                                    class="bi bi-check2"></i> Set</button>
                                        </form>
                                    </div>
                                </div>
                                @if ($latest_school_session_id == $current_school_session_id)
                                    <div class="col-md-4 mb-4">
                                        <div class="p-3 border bg-light shadow-sm">
                                            <h6>Create Semester for Current Session</h6>
                                            <form action="https://sim-academy.vercel.app/semester/store" method="POST">
                                                @csrf
                                                <input type="hidden" name="session_id"
                                                    value="{{ $current_school_session_id }}">
                                                <div class="mt-2">
                                                    <p>Semester name<sup><i class="bi bi-asterisk text-primary"></i></sup>
                                                    </p>
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="First Semester" aria-label="Semester name"
                                                        name="semester_name" required>
                                                </div>
                                                <div class="mt-2">
                                                    <label for="inputStarts" class="form-label">Starts<sup><i
                                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                                    <input type="date" class="form-control form-control-sm"
                                                        id="inputStarts" placeholder="Starts" name="start_date" required>
                                                </div>
                                                <div class="mt-2">
                                                    <label for="inputEnds" class="form-label">Ends<sup><i
                                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                                    <input type="date" class="form-control form-control-sm"
                                                        id="inputEnds" placeholder="Ends" name="end_date" required>
                                                </div>
                                                <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i
                                                        class="bi bi-check2"></i> Create</button>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4 mb-4">
                                        <div class="p-3 border bg-light shadow-sm">
                                            <h6>Attendance Type</h6>
                                            <p class="text-danger">
                                                <small><i class="bi bi-exclamation-diamond-fill me-2"></i> Do not change the
                                                    type in the middle of a Semester.</small>
                                            </p>
                                            <form action="https://sim-academy.vercel.app/attendence/update" method="POST">
                                                @csrf
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="attendance_type"
                                                        id="attendance_type_section" value="section">
                                                    <label class="form-check-label" for="attendance_type_section">
                                                        Attendance by Section
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="attendance_type"
                                                        id="attendance_type_course" value="course">
                                                    <label class="form-check-label" for="attendance_type_course">
                                                        Attendance by Course
                                                    </label>
                                                </div>

                                                <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i
                                                        class="bi bi-check2"></i> Save</button>
                                            </form>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-4 mb-4">
                                        <div class="p-3 border bg-light shadow-sm">
                                            <h6>Create Class</h6>
                                            <form action="https://sim-academy.vercel.app/class/store" method="POST">
                                                @csrf
                                                <input type="hidden" name="session_id"
                                                    value="{{ $current_school_session_id }}">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="class_name" placeholder="Class name"
                                                        aria-label="Class name" required>
                                                </div>
                                                <button class="btn btn-sm btn-outline-primary" type="submit"><i
                                                        class="bi bi-check2"></i> Create</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="p-3 border bg-light shadow-sm">
                                            <h6>Create Section</h6>
                                            <form action="https://sim-academy.vercel.app/section/store" method="POST">
                                                @csrf
                                                <input type="hidden" name="session_id"
                                                    value="{{ $current_school_session_id }}">
                                                <div class="mb-3">
                                                    <input class="form-control form-control-sm" name="section_name"
                                                        type="text" placeholder="Section name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <input class="form-control form-control-sm" name="room_no"
                                                        type="text" placeholder="Room No." required>
                                                </div>
                                                <div>
                                                    <p>Assign section to class:</p>
                                                    <select class="form-select form-select-sm"
                                                        aria-label=".form-select-sm" name="class_id" required>
                                                        @isset($school_classes)
                                                            @foreach ($school_classes as $school_class)
                                                                <option value="{{ $school_class->id }}">
                                                                    {{ $school_class->class_name }}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                                <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i
                                                        class="bi bi-check2"></i> Save</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="p-3 border bg-light shadow-sm">
                                            <h6>Create Course</h6>
                                            <form action="https://sim-academy.vercel.app/course/store" method="POST">
                                                @csrf
                                                <input type="hidden" name="session_id"
                                                    value="{{ $current_school_session_id }}">
                                                <div class="mb-1">
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="course_name" placeholder="Course name"
                                                        aria-label="Course name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <p class="mt-2">Course Type:<sup><i
                                                                class="bi bi-asterisk text-primary"></i></sup></p>
                                                    <select class="form-select form-select-sm" name="course_type"
                                                        aria-label=".form-select-sm" required>
                                                        <option value="Core">Core</option>
                                                        <option value="General">General</option>
                                                        <option value="Elective">Elective</option>
                                                        <option value="Optional">Optional</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <p>Assign to semester:<sup><i
                                                                class="bi bi-asterisk text-primary"></i></sup></p>
                                                    <select class="form-select form-select-sm"
                                                        aria-label=".form-select-sm" name="semester_id" required>
                                                        @isset($semesters)
                                                            @foreach ($semesters as $semester)
                                                                <option value="{{ $semester->id }}">
                                                                    {{ $semester->semester_name }}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <p>Assign to class:<sup><i
                                                                class="bi bi-asterisk text-primary"></i></sup></p>
                                                    <select class="form-select form-select-sm"
                                                        aria-label=".form-select-sm" name="class_id" required>
                                                        @isset($school_classes)
                                                            @foreach ($school_classes as $school_class)
                                                                <option value="{{ $school_class->id }}">
                                                                    {{ $school_class->class_name }}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                                <button class="btn btn-sm btn-outline-primary" type="submit"><i
                                                        class="bi bi-check2"></i> Create</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="p-3 border bg-light shadow-sm">
                                            <h6>Assign Teacher</h6>
                                            <form action="https://sim-academy.vercel.app/teacher/assign" method="POST">
                                                @csrf
                                                <input type="hidden" name="session_id"
                                                    value="{{ $current_school_session_id }}">
                                                <div class="mb-3">
                                                    <p class="mt-2">Select Teacher:<sup><i
                                                                class="bi bi-asterisk text-primary"></i></sup></p>
                                                    <select class="form-select form-select-sm"
                                                        aria-label=".form-select-sm" name="teacher_id" required>
                                                        @isset($teachers)
                                                            @foreach ($teachers as $teacher)
                                                                <option value="{{ $teacher->id }}">
                                                                    {{ $teacher->first_name }} {{ $teacher->last_name }}
                                                                </option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <p>Assign to semester:<sup><i
                                                                class="bi bi-asterisk text-primary"></i></sup></p>
                                                    <select class="form-select form-select-sm"
                                                        aria-label=".form-select-sm" name="semester_id" required>
                                                        @isset($semesters)
                                                            @foreach ($semesters as $semester)
                                                                <option value="{{ $semester->id }}">
                                                                    {{ $semester->semester_name }}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                                <div>
                                                    <p>Assign to class:<sup><i
                                                                class="bi bi-asterisk text-primary"></i></sup></p>
                                                    <select id="inputAssignToClass" class="form-select form-select-sm"
                                                        aria-label=".form-select-sm" name="class_id" required>
                                                        @isset($school_classes)
                                                            <option selected disabled>Please select a class</option>
                                                            @foreach ($school_classes as $school_class)
                                                                <option value="{{ $school_class->id }}">
                                                                    {{ $school_class->class_name }}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                                <div>
                                                    <p class="mt-2">Assign to section:<sup><i
                                                                class="bi bi-asterisk text-primary"></i></sup></p>
                                                    <select class="form-select form-select-sm" id="section-select"
                                                        aria-label=".form-select-sm" name="section_id" required>
                                                        @if ($school_sections->isNotEmpty())
                                                            <option>Select a section</option>
                                                            @foreach ($school_sections as $school_section)
                                                                <option value="{{ $school_section->id }}">
                                                                    {{ $school_section->section_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div>
                                                    <p class="mt-2">Assign to course:<sup><i
                                                                class="bi bi-asterisk text-primary"></i></sup></p>
                                                    <select class="form-select form-select-sm" id="course-select"
                                                        aria-label=".form-select-sm" name="course_id" required>
                                                        @if ($school_sections->isNotEmpty())
                                                            <option>Select a course</option>
                                                            @foreach ($courses as $courses)
                                                                <option value="{{ $courses->id }}">
                                                                    {{ $courses->course_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i
                                                        class="bi bi-check2"></i> Save</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="p-3 border bg-light shadow-sm">
                                            <h6>Allow Final Marks Submission</h6>
                                            <form action="https://sim-academy.vercel.app/final-marks-submission-status/update"
                                                method="POST">
                                                @csrf
                                                <p class="text-danger">
                                                    <small><i class="bi bi-exclamation-diamond-fill me-2"></i> Usually
                                                        teachers are allowed to submit final marks just before the end of a
                                                        "Semester".</small>
                                                </p>
                                                <p class="text-primary">
                                                    <small><i class="bi bi-exclamation-diamond-fill me-2"></i> Disallow at
                                                        the start of a "Semester".</small>
                                                </p>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="marks_submission_status" id="marks_submission_status_check">
                                                    <label class="form-check-label"
                                                        for="marks_submission_status_check"></label>
                                                </div>
                                                <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i
                                                        class="bi bi-check2"></i> Save</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#inputAssignToClass').change(function() {
                var classId = $(this).val();
                var url = '{{ route('
                get.sections.courses.by.classId ','
                classId ';
                url = url.replace('classId', classId);
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.sections) {
                            var sectionsDropdown = $('#inputAssignToSection');
                            sectionsDropdown.empty();
                            sectionsDropdown.append($('<option>').text(
                                'Please select a section').attr('value', 0))
                            response.sections.forEach(function(section) {
                                sectionsDropdown.append($('<option>').text(section
                                    .section_name).attr('value', section.id));
                            });
                        }
                    }
                })
            })
        });
    </script>
@endsection
