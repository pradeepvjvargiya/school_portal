@extends('layouts.app')

@section('title', 'Add student')

@section('content')
    <div class="container">
        <h5 class="col-lg-12 mb-3 text-center">Add Student</h5>
        <form class="col-lg-12 row" action="{{ route('student/store') }}" method="post" enctype="multipart/form-data"
            autocomplete="off">
            @csrf
            {{-- Name and father's name --}}
            <div class="row">
                <div class="mb-3 col-lg-6">
                    <div class="form-floating">
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"
                            autocomplete="off">
                        <label for="name">Name</label>
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 col-lg-6">
                    <div class="form-floating">
                        <input type="text" name="father_name" id="father_name" value="{{ old('father_name') }}"
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
                        <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}" class="form-control"
                            autocomplete="off">
                        <label for="mobile">Mobile</label>
                    </div>
                    @error('mobile')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 col-lg-6">
                    <div class="form-floating">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control"
                            autocomplete="off">
                        <label for="email">Email</label>
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            {{-- Address and password --}}
            <div class="row">
                <div class="mb-3 col-lg-6">
                    <div class="form-floating">
                        <textarea name="address" id="address" class="form-control" autocomplete="off">{{ old('address') }}</textarea>
                        <label for="address">Address</label>
                    </div>
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 col-lg-6">
                    <div class="form-floating">
                        <input type="password" name="password" id="password" class="form-control" autocomplete="off">
                        <label for="password">Password</label>
                    </div>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            {{-- city and state --}}
            <div class="row">
                <div class="mb-3 col-lg-6">
                    <div class="form-floating">
                        <input type="text" name="city" id="city" value="{{ old('city') }}"
                            class="form-control" autocomplete="off">
                        <label for="city">City</label>
                    </div>
                    @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 col-lg-6">
                    <div class="form-floating">
                        <input type="text" name="state" id="state" value="{{ old('state') }}"
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
                <div class="col-lg-6">
                    <div class="form-floating">
                        <input type="file" name="image" id="image" class="form-control" onchange="previewImage()">
                        <label for="image">Image</label>
                    </div>
                    <img id="preview" width="100" height="100" style="display: none;" />
                    @error('image')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            {{-- Add button --}}
            <div class="row">
                <div class="mt-3 col-lg-6">
                    <input type="submit" value="Add Student" class="btn btn-primary">
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
