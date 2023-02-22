@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Student</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('students.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <strong>First Name:</strong>
                    <input type="text" name="first_name" value="{{ $student->first_name }}" class="form-control" placeholder="First Name">
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <strong>last Name:</strong>
                    <textarea class="form-control" style="height:50px" name="last_name"
                        placeholder="Last Name">{{ $student->last_name }}</textarea>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <strong>Student Id:</strong>
                    <input type="text" name="student_id" class="form-control" placeholder="{{ $student->student_id }}"
                        value="{{ $student->student_id }}">
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <strong>Age:</strong>
                    <input type="number" name="age" class="form-control" placeholder="{{ $student->age }}"
                        value="{{ $student->age }}">
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <strong>Department:</strong>
                    <select id="department_id" name="department_id" class="form-control">
                        <option selected value="">Choose a Department</option>
                        @foreach($departments as $list)
                        <option value="{{$list->id}}" @if($list->id==$student->department_id) selected @endif >{{$list->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <strong>Subject:</strong>
                    <select id="subjects_id" name="subjects_id[]" class="select form-control" multiple>
                        <?php //dd($student->subjects); ?>
                        @foreach($subjects as $list)
                            <option value="{{$list->id}}" @forelse($student->subjects as $slist) @if($list->id==$slist->id) selected @endif @empty '' @endforelse >{{$list->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
<script>
$(document).ready(function() {
    "use strict";
    $('.select').select2({
        placeholder: "Select Your Subjects",
        allowClear: true
    });
})
</script>