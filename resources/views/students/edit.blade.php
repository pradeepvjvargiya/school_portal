@extends('layouts.app')

@section('title', 'Edit Form')

@section('content')
    <div class="container">
        <h5 class="mb-3 text-center">Update: Student Details</h5>
        <form action="{{ route('student/update', $student->id) }}" method="POST" enctype="multipart/form-data"
            autocomplete="off">
            @csrf
            @method('PUT')
            {{-- Name and father's name --}}
            <div class="row">
                <div class="mb-3 col-lg-6">
                    <div class="form-floating">
                        <input type="text" name="name" id="name" value="{{ $student->name }}" class="form-control"
                            autocomplete="off">
                        <label for="name">Name</label>
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <div class="form-floating">
                        <input type="text" name="father_name" id="father_name" value="{{ $student->father_name }}"
                            class="form-control" autocomplete="off">
                        <label for="father_name">Father's Name</label>
                    </div>
                    @error('father_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            {{-- Mobile and Email --}}
            <div class="row">
                <div class="mb-3 col-lg-6">
                    <div class="form-floating">
                        <input type="text" name="mobile" id="mobile" value="{{ $student->mobile }}"
                            class="form-control" autocomplete="off">
                        <label for="mobile">Mobile</label>
                    </div>
                    @error('mobile')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <div class="form-floating">
                        <input type="email" name="email" id="email" value="{{ $student->email }}"
                            class="form-control" autocomplete="off">
                        <label for="email">Email</label>
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            {{-- Address --}}
            <div class="row">
                <div class="mb-3 col-lg-12">
                    <div class="form-floating">
                        <textarea name="address" id="address" class="form-control" autocomplete="off">{{ $student->address }}</textarea>
                        <label for="address">Address</label>
                    </div>
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            {{-- state and city --}}
            <div class="row">
                <div class="mb-3 col-lg-6">
                    <div class="form-floating">
                        <input type="text" name="city" id="city" value="{{ $student->city }}"
                            class="form-control" autocomplete="off">
                        <label for="city">City</label>
                    </div>
                    @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-lg-6">
                    <div class="form-floating">
                        <input type="text" name="state" id="state" value="{{ $student->state }}"
                            class="form-control" autocomplete="off">
                        <label for="state">State</label>
                    </div>
                    @error('state')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            {{-- image --}}
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="form-floating">
                        <input type="file" name="image" id="image" class="form-control" onchange="previewImage()">
                        <label for="image">Image</label>
                    </div>
                    <img src="{{ asset('storage/' . $student->image) }}" id="preview" width="100" height="100"
                        alt="Student">
                    @error('image')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            {{-- Add button --}}
            <div class="row">
                <div class="mt-3 col-lg-6">
                    <input type="submit" value="Update Student Details" class="btn btn-primary">
                    <a href="{{ url('student/list') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </form>
    </div>
    <script>
        function previewImage() {
            var input = document.getElementById('image');
            var preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>

@endsection
