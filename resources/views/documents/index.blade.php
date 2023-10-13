@extends('layouts.app')

@section('title', 'Document')

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

    .data-list {
        background-image: url('your-background-image.jpg');
        border: 1px solid #000;
        /* Set border properties as needed */
        padding: 20px;
        /* Add padding for spacing */
        list-style-type: none;
        /* Remove list-style bullets */
    }

    .data-list li {
        /* margin: 5px 0; */
        /* Adjust margin for list items */
    }

    .round-image {
        border-radius: 50%;
        /* Make the profile image round */
    }
</style>

@section('content')
    <div class="row container mx-auto my-1">
        <div class="col-lg-6">
            <ul class="data-list">
                <li>Profile Image: <img class="round-image" src="{{ asset('storage/' . '/' . $student->image) }}"
                        width="100" height="100" /></li>
                <li>Student Id: {{ $student->id }}</li>
                <li>Role: {{ $student->role }}</li>
                <li>Name: {{ $student->name }}</li>
                <li>Father's Name: {{ $student->father_name }}</li>
                <li>Mobile: {{ $student->mobile }}</li>
                <li>Email: {{ $student->email }}</li>
                <li>Address: {{ $student->address }}</li>
                <li>City: {{ $student->city }}</li>
                <li>State: {{ $student->state }}</li>
            </ul>
        </div>
        @if (auth()->user()->role == 'admin' || auth()->user()->id == $student->id)
            <div class="col-6 mt-3">
                <div class="row">
                    <div class="col-4 mt-3 text-end px-3">
                        <a class="btn btn-primary btn-sm"
                            href="{{ url("student/{$student->id}/documents/add") }}"><span>Add
                                New
                                Document</span></a>
                    </div>
                    <div class="col-4 mt-3 text-end px-3">
                        <a class="btn btn-primary btn-sm"
                            href="{{ url("student/{$student->id}/documents/addMultiple") }}"><span>Add
                                Multiple
                                Document</span></a>
                    </div>
                    <div class="col-4 mt-3 text-end px-3">
                        <a type="button" href="{{ url('/student/edit/' . $student->id) }}"
                            class="btn btn-primary btn-sm">Edit
                            Profile</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- For single file --}}
    <div class="container">

        <table class="table table-striped table-bordered" id="myTable">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Doument Name</th>
                    <th scope="col">File</th>
                    @if (auth()->user()->role == 'admin' || auth()->user()->id == $student->id)
                        <th colspan="2">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($studentDocuments as $studentDocument)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>{{ $studentDocument->document }}</td>
                        <td>
                            @if ($studentDocument->file)
                                <img class="round-image" src="{{ asset('storage/' . $studentDocument->file) }}"
                                    style="height: 100px;width:100px;">
                            @else
                                <span>No image found!</span>
                            @endif
                        </td>
                        @if (auth()->user()->role == 'admin' || auth()->user()->id == $student->id)
                            <td><a type="button"
                                    href="{{ url('/student/' . $studentDocument->student->id . '/document/' . $studentDocument->id) }}"
                                    class="btn btn-primary btn-sm">Edit</a></td>
                            <td><a type="button"
                                    href="{{ route('documents.destroy', ['student_id' => $student->id, 'document_id' => $studentDocument->id]) }}"
                                    class="btn btn-primary btn-sm">Delete</a></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $studentDocuments->links() }}
    </div>
@endsection
