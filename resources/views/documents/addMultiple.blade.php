@extends('layouts.app')

@section('title', 'Add Document')

@section('content')
    <div class="container">
        <h5 class="col-lg-12 mb-3 text-center">Add Multiple Documents</h5>
        <div id="container">
            <form class="col-lg-12 row" action="{{ route('documents.storeMultiple', $student_id) }}" method="POST"
                enctype="multipart/form-data" autocomplete="off">
                @csrf
                {{-- document --}}
                <div class="row imageMultiple">
                    <div class="col-6">
                        <div class="form-floating">
                            <input type="text" name="document[]" id="document" value="{{ old('document') }}"
                                class="form-control" autocomplete="off">
                            <label for="document">Document:</label>
                        </div>
                        <span>
                            @error('document')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </span>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-floating">
                            <input type="file" name="file[]" multiple id="file" class="form-control"
                                onchange="previewImage()">
                            <label for="file">Image</label>
                        </div>
                        <img id="preview" width="100" height="100" style="display: none;" />
                        <span>
                            @error('file')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <div id="additionalInputsContainer"></div>

                {{-- Add more --}}
                <div class="mt-2">
                    <button type="button" id="addMore" onclick="addMoreInputFields()">Add More</button>
                </div>

                {{-- Add button --}}
                <div class="row">
                    <div class="mt-3 col-lg-6">
                        <input type="submit" value="Add Document" class="btn btn-primary">
                        <a href="{{ url('student/' . $student_id . '/documents') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <script>
        function addMoreInputFields() {
            const container = document.getElementById('additionalInputsContainer');
            const newInputFields = document.createElement('div');

            newInputFields.innerHTML = `
                    <div class="row imageMultiple">
                        <div class="col-6">
                            <div class="form-floating">
                                <input type="text" name="document[]" class="form-control" autocomplete="off">
                                <label for="document">Document:</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating">
                                <input type="file" name="file[]" multiple class="form-control">
                                <label for="file">Image</label>
                            </div>
                            <img id="preview" width="100" height="100" style="display: none;" />
                        </div>
                    </div>
                `;

            container.appendChild(newInputFields);
        }

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
