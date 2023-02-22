@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Student</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('students.index') }}" title="Go back"> <i
                    class="fas fa-backward "></i> </a>
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
<form action="{{ route('students.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <strong>First Name:</strong>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="First Name">
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <strong>Last Name:</strong>
                <input class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <strong>Student Id:</strong>
                <input type="text" name="student_id" class="form-control" value="{{ old('student_id') }}" placeholder="Student Id">
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <strong>Age:</strong>
                <input type="number" name="age" class="form-control" value="{{ old('age') }}" placeholder="Age">
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <strong>Department:</strong>
                <select id="department_id" name="department_id" class="form-control">
                    <option selected value="">Choose a Department</option>
                    @foreach($departments as $list)
                    <option value="{{$list->id}}" {{ old('department_id') == $list->id ? 'selected' : '' }}>{{$list->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <strong>Subject:</strong>
                <select id="subjects_id" name="subjects_id[]" class="select form-control" multiple>
                    @foreach($subjects as $list)
                    <option value="{{$list->id}}" {{ (in_array($list->id, old('subjects_id', []))) ? 'selected' : '' }}>{{$list->name}}</option>
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