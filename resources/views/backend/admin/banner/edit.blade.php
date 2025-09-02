@extends('layout.adminapp')

@section('content')
    <div class="content-wrapper">
        @include('message')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">
                    <a href="{{ route('admin.banner.index') }}" class="text-muted">Banners</a> /
                </span>
                Edit Banner
            </h4>

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit Banner</h5>
                        </div>

                        <div class="card-body">
                            <form id="bannerForm" action="{{ route('admin.banner.update', $banner->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')


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
                                        @if ($banner->image)
                                            <img id="previewImage" src="{{ asset($banner->image) }}" alt="Image Preview"
                                                style="max-width: 150px; margin-top: 10px; display: block;" />
                                        @else
                                            <img id="previewImage" src="#" alt="Image Preview"
                                                style="max-width: 150px; margin-top: 10px; display: none;" />
                                        @endif
                                    </div>
                                </div>

                                {{-- Title --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                                            <input type="text" name="title" id="title" class="form-control"
                                                value="{{ old('title', $banner->title) }}" placeholder="Banner Title" />
                                        </div>
                                        @error('title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Page --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Page</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-file"></i></span>
                                            <select name="page" id="page" class="form-select">
                                                <option value="">Select Page</option>
                                                <option value="home"
                                                    {{ old('page', $banner->page) == 'home' ? 'selected' : '' }}>Home
                                                </option>
                                                <option value="about"
                                                    {{ old('page', $banner->page) == 'about' ? 'selected' : '' }}>About
                                                </option>
                                                <option value="services"
                                                    {{ old('page', $banner->page) == 'services' ? 'selected' : '' }}>
                                                    Services</option>
                                                <option value="contact"
                                                    {{ old('page', $banner->page) == 'contact' ? 'selected' : '' }}>Contact
                                                </option>
                                            </select>
                                        </div>
                                        @error('page')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Sort Order --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Sort Order</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-sort"></i></span>
                                            <input type="number" name="sort_order" id="sort_order" class="form-control"
                                                value="{{ old('sort_order', $banner->sort_order) }}"
                                                placeholder="Sort Order" />
                                        </div>
                                        @error('sort_order')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Description --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-text"></i></span>
                                            <textarea name="description" id="description" class="form-control" placeholder="Description">{{ old('description', $banner->description) }}</textarea>
                                        </div>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <x-logos.status name="status" :value="$banner->status" />
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button id="submitBtn" class="btn btn-primary" type="submit">
                                            Update
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
