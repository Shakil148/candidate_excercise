@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Student Details</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('students.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <strong>First Name:</strong>
                {{ $student->first_name }}
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <strong>Last Name:</strong>
                {{ $student->last_name }}
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <strong>Student Id:</strong>
                {{ $student->student_id }}
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <strong>Age:</strong>
                {{ $student->age }}
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <strong>Department:</strong>
                {{ $student->department->name ?? '' }}
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <strong>Subjects:</strong>
                <?php //dd($student->subjects) ?>
                @forelse($student->subjects  as $list)
                    {{ $list->name ?? '' }}@if (!$loop->last),@endif
                @empty
                    ''
                @endforelse
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <strong>Date Created:</strong>
                {{ $student->created_at?date_format($student->created_at, 'jS M Y'):"" }}
            </div>
        </div>
    </div>
@endsection