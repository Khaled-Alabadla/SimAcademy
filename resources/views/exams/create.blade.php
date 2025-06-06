@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            @include('layouts.left-menu')
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
                <div class="row pt-2">
                    <div class="col ps-4">
                        <h1 class="display-6 mb-3"><i class="bi bi-file-plus"></i> Create Exam</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create Exam</li>
                            </ol>
                        </nav>
                        @include('session-messages')
                        <div class="row">
                            <div class="col-md-5 mb-4">
                                <div class="p-3 border bg-light shadow-sm">
                                    <form action="https://sim-academy.vercel.app/exams/store" method="POST">
                                        @csrf
                                        <input type="hidden" name="session_id" value="{{ $current_school_session_id }}">
                                        <div>
                                            <p>Select Semester:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                            <select class="form-select" name="semester_id">
                                                @isset($semesters)
                                                    <option selected disabled>Please select a Semester</option>
                                                    @foreach ($semesters as $semester)
                                                        <option value="{{ $semester->id }}">{{ $semester->semester_name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        <div>
                                            <p class="mt-2">Select class:<sup><i
                                                        class="bi bi-asterisk text-primary"></i></sup></p>
                                            <select class="form-select" name="class_id" id="getcoursebyclass">
                                                @isset($classes)
                                                    <option selected disabled>Please select a class</option>
                                                    @foreach ($classes as $school_class)
                                                        <option value="{{ $school_class->id }}">{{ $school_class->class_name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        <div>
                                            <p class="mt-2">Select course:<sup><i
                                                        class="bi bi-asterisk text-primary"></i></sup></p>
                                            <select class="form-select" id="course-select" name="course_id">
                                            </select>
                                        </div>
                                        <div class="mt-2">
                                            <p>Exam name<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                            <input type="text" class="form-control" name="exam_name"
                                                placeholder="Quiz, Assignment, Mid term, Final, ..."
                                                aria-label="Quiz, Assignment, Mid term, Final, ...">
                                        </div>
                                        <div class="mt-2">
                                            <label for="inputStarts" class="form-label">Starts<sup><i
                                                        class="bi bi-asterisk text-primary"></i></sup></label>
                                            <input type="datetime-local" class="form-control" id="inputStarts"
                                                name="start_date" placeholder="Starts">
                                        </div>
                                        <div class="mt-2">
                                            <label for="inputEnds" class="form-label">Ends<sup><i
                                                        class="bi bi-asterisk text-primary"></i></sup></label>
                                            <input type="datetime-local" class="form-control" id="inputEnds" name="end_date"
                                                placeholder="Ends">
                                        </div>
                                        <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i
                                                class="bi bi-check2"></i> Create</button>
                                    </form>
                                </div>
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
            $('#getcoursebyclass').change(function() {
                var classId = $(this).val();
                var url = '{{ route('get.sections.courses.by.classId', 'classId') }}';
                url = url.replace('classId', classId);
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.courses) {
                            var sectionsDropdown = $('#course-select');
                            sectionsDropdown.empty();
                            sectionsDropdown.append($('<option>').text('Please select a course')
                                .attr('value', 0))
                            response.courses.forEach(function(course) {
                                sectionsDropdown.append($('<option>').text(course
                                    .course_name).attr('value', course.id));
                            });
                        }
                    }
                })
            })
        });
    </script>
@endsection
