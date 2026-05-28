@extends('layout.adminapp')

@section('content')
    <div class="content-wrapper">
        @include('message')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">
                    <a href="{{ route('admin.category.index') }}" class="text-muted">Categories</a> /
                </span>
                Add Category
            </h4>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Add Category</h5>
                        </div>
                        <div class="card-body">
                            <form id="categoryForm" action="{{ route('admin.category.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- Name --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ old('name') }}" placeholder="Category Name" />
                                        </div>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Slug --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Slug</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                                            <input type="text" name="slug" id="slug" class="form-control"
                                                value="{{ old('slug') }}" placeholder="slug" />
                                        </div>
                                        @error('slug')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Image --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-image"></i></span>
                                            <input type="file" name="image" class="form-control"
                                                onchange="checkImage(this)" />
                                        </div>
                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <img id="previewImage" src="#" alt="Image Preview"
                                            style="max-width: 150px; margin-top: 10px; display: none;" />
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <x-logos.status />
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button class="btn btn-primary" type="submit">
                                            Save
                                            <x-loader-icon />
                                        </button>

                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Slug generation
            $('#name').on('input', function() {
                var name = $(this).val();
                var slug = name
                    .toLowerCase()
                    .trim()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-');
                $('#slug').val(slug);
            });

            // Loader display on submit
            $('#categoryForm').on('submit', function() {
                $('.loader-icon').removeClass('d-none'); // show loader
                $('#submitBtn').attr('disabled', true); // prevent multiple submissions
            });
        });

        // Image preview
        function checkImage(input) {
            var file = input.files[0];
            if (file && validateFile(file, 2, true)) {
                var imagePreview = document.getElementById("previewImage");
                var fileURL = URL.createObjectURL(file);
                imagePreview.src = fileURL;
                imagePreview.style.display = 'block';
            } else {
                input.value = '';
                alert('Invalid file. Only images up to 2MB are allowed.');
            }
        }

        // File validation
        function validateFile(file, maxSizeMB = 2, onlyImage = true) {
            var validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
            var maxSizeBytes = maxSizeMB * 1024 * 1024;

            if (onlyImage && !validTypes.includes(file.type)) {
                return false;
            }

            if (file.size > maxSizeBytes) {
                return false;
            }

            return true;
        }
    </script>
@endsection
