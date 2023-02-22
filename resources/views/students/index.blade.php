@extends('layouts.app')
@section('title', 'Student List')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Students List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('export.csv') }}" title="Export all student"> <i class="fas fa-download-circle">Export File</i>
                    </a>
                <a class="btn btn-success" href="{{ route('students.create') }}" title="Create a student"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Student Id</th>
            <th>Age</th>
            <th>Department</th>
            <!-- <th>Subject</th> -->
            <th colspan="3">Action</th>
        </tr>
        @foreach ($students as $student)
        <?php //dd($student->subjects->name) ?>
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $student->first_name }}</td>
                <td>{{ $student->last_name }}</td>
                <td>{{ $student->student_id }}</td>
                <td>{{ $student->age }}</td>
                <td>{{ $student->department->name ?? '' }}</td>
                {{-- @forelse ($student->subjects as $list)
                    <td>{{ $list->name ?? '' }}</td>
                @empty   
                    <td></td>
                @endforelse --}}
                <td>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST">

                        <a href="{{ route('students.show', $student->id) }}" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="{{ route('students.edit', $student->id) }}">
                            <i class="fas fa-edit  fa-lg"></i>

                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" onclick="return confirm('Are you sure?')" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>

                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $students->links() !!}

@endsection