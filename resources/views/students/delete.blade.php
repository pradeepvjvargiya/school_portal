@extends('layouts.app')

@section('title', 'Delete Form')

@section('content')
    <section class="section" style="min-height:100vh">
        <div class="row d-flex">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body col-lg-12">
                        <h5 class="card-title col-lg-12">Delete: Student Details</h5>
                        <form action="{{ route('student/destroy', $student->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('DELETE')
                            {{-- Name and father's name --}}
                            <div class="row">
                                <div class="mb-3 col-lg-6 d-flex">
                                    <label for="name" class="col-lg-4 col-form-label">Name:</label>
                                    <input type="text" name="name" id="name" value="{{ $student->name }}"
                                        class="form-control" autocomplete="off" disabled>
                                    <span>
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3 col-lg-6 d-flex">
                                    <label for="father_name" class="col-lg-4 col-form-label">Father's Name:</label>
                                    <input type="text" name="father_name" id="father_name" value="{{ $student->father_name }}"
                                        class="form-control" autocomplete="off" disabled>
                                    <span>
                                        @error('father_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            {{-- Mobile and Email --}}
                            <div class="row">
                                <div class="mb-3 col-lg-6 d-flex">
                                    <label for="mobile" class="col-lg-4 col-form-label">Mobile:</label>
                                    <input type="text" name="mobile" id="mobile" value="{{ $student->mobile }}"
                                        class="form-control" autocomplete="off" disabled>
                                    <span>
                                        @error('mobile')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3 col-lg-6 d-flex">
                                    <label for="email" class="col-lg-4 col-form-label">Email</label>
                                    <input type="email" name="email" id="email" value="{{ $student->email }}"
                                        class="form-control" autocomplete="off" disabled>
                                    <span>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            {{-- Address, state and city --}}
                            <div class="row">
                                <div class="mb-3 col-lg-12 d-flex">
                                    <label for="address" class="col-lg-2 col-form-label">Address:</label>
                                    <textarea name="address" id="address" class="form-control" autocomplete="off">{{ $student->address }}</textarea>
                                    <span>
                                        @error('address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-lg-6 d-flex">
                                    <label for="city" class="col-lg-4 col-form-label">City</label>
                                    <input type="text" name="city" id="city" value="{{ $student->city }}"
                                        class="form-control" autocomplete="off" disabled>
                                    <span>
                                        @error('city')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3 col-lg-6 d-flex">
                                    <label for="state" class="col-lg-4 col-form-label">State</label>
                                    <input type="text" name="state" id="state" value="{{ $student->state }}"
                                        class="form-control" autocomplete="off" disabled>
                                    <span>
                                        @error('state')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            {{-- image --}}
                            <div class="row">
                                <div class="col-6">
                                    <label for="image" class="col-lg-4 col-form-label">Image:</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    <img src="{{ asset('storage/'.$student->image) }}"  width="100" height="100" alt="Student">
                                    <span>
                                        @error('image')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-6"></div>
                            </div>
                            {{-- Add button --}}
                            <div class="row">
                                <div class="mb-3 col-lg-6 d-flex">
                                    <input type="submit" value="Update Student Details">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
