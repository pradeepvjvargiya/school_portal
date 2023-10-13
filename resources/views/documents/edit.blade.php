@extends('layouts.app')

@section('title', 'Edit Student document Form')

@section('content')
    <div class="container">
        <h5 class="col-lg-12 mb-3 text-center">Edit Document</h5>
        <form class="col-lg-12 row"
            action="{{ route('documents.update', ['student_id' => $student_id, 'document_id' => $studentDocument->id]) }}"
            method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
            {{-- Documents --}}
            <div class="row">
                <div class="mb-3 col-lg-6">
                    <div class="form-floating">
                        <input type="text" name="document" id="document" value="{{ $studentDocument->document }}"
                            class="form-control" autocomplete="off">
                        <label for="document">Document:</label>
                    </div>
                    @error('document')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- image --}}
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-floating">
                        <input type="file" name="file" id="file" class="form-control" onchange="previewImage()">
                        <label for="file">Image</label>
                    </div>
                    <img src="{{ asset('storage/' . $studentDocument->file) }}" id="preview" width="100" height="100"
                        alt="Student">
                    @error('file')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            {{-- Add button --}}
            <div class="row">
                <div class="mt-3 col-lg-6">
                    <input type="submit" value="Update Document" class="btn btn-primary">
                    <a href="{{ url('student/{student_id}/documents') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </form>
    </div>
    <script>
        function previewImage() {
            var input = document.getElementById('file');
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
