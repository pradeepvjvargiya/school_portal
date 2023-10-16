@extends('layouts.app')

@section('title', 'Student List')

<style>
    .round-image {
        border-radius: 50%;
        margin-right: 10px;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    th,
    td {
        vertical-align: middle;
    }
</style>

@section('content')
    <div class="container mx-end my-1">
        @if (auth()->user()->role == 'admin')
            <a class="btn btn-primary btn-sm" href="{{ route('students.create') }}"><span>Add Student</span></a>
        @endif
    </div>
    <div class="container">
        <table class="table table-striped table-bordered" id="myTable">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Father's Name</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    @if (auth()->user()->role == 'admin')
                        <th colspan="2">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $key=>$student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ url("student/{$student->id}/documents") }}"></a>
                            @if ($student->image)
                                <a href="{{ url("student/{$student->id}/documents") }}">
                                    <img class="round-image" src="{{ asset('storage/' . $student->image) }}"
                                        style="height: 100px; width: 100px;">
                                </a>
                            @else
                                <span>No image found!</span>
                            @endif
                        </td>
                        <td><a href="{{ url("student/{$student->id}/documents") }}">{{ $student->name }}</a></td>
                        <td>{{ $student->father_name }}</td>
                        <td>{{ $student->mobile }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->address }}</td>
                        <td>{{ $student->city }}</td>
                        <td>{{ $student->state }}</td>
                        <!-- Check if the student's ID matches the logged-in user's ID -->
                        @if (auth()->user()->role == 'admin')
                            <td>
                                <a type="button" href="{{ url('/student/edit/' . $student->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                        @endif
                         @if (auth()->user()->role == 'admin') 
                            <td><a type="button" href="{{ url('/student/delete/' . $student->id) }}"
                                    class="btn btn-primary btn-sm">Delete</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $students->links() }}
    </div>
@endsection
