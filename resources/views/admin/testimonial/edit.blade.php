@extends('layout.adminapp')
@section('content')
    <div class="content-wrapper">
        @include('message')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">
                    <a href="{{ route('admin.testimonial.index') }}" class="text-muted">Testimonials</a> /
                </span>
                Edit Testimonial
            </h4>

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit Testimonial</h5>
                        </div>

                        <div class="card-body">
                            <form id="testimonialForm" action="{{ route('admin.testimonial.update', $testimonial->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">

                                        @if ($testimonial->image)
                                            <img id="previewImage" src="{{ $testimonial->image_url }}" alt="Image Preview"
                                                style="max-width: 150px; margin-top: 10px; display: block;" />
                                        @else
                                            <img id="previewImage" src="#" alt="Image Preview"
                                                style="max-width: 150px; margin-top: 10px; display: none;" />
                                        @endif
                                        <div class="input-group input-group-merge mt-3">
                                            <span class="input-group-text"><i class="bx bx-image"></i></span>
                                            <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp,image/gif"
                                                onchange="checkImage(this)" />
                                        </div>
                                        @if ($testimonial->image)
                                            <div class="form-check mt-2">
                                                <input type="checkbox" name="remove_image" id="remove_image" value="1" class="form-check-input" @checked(old('remove_image'))>
                                                <label for="remove_image" class="form-check-label">Remove current image</label>
                                            </div>
                                        @endif
                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $testimonial->name) }}" maxlength="120" required placeholder="Name" />
                                        </div>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="role" class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-briefcase"></i></span>
                                            <input type="text" name="role" id="role" class="form-control" value="{{ old('role', $testimonial->role) }}" maxlength="120" required placeholder="Role" />
                                        </div>
                                        @error('role')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="quote" class="col-sm-2 col-form-label">Quote</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-text"></i></span>
                                            <textarea name="quote" id="quote" class="form-control" rows="4" maxlength="2000" required placeholder="Quote">{{ old('quote', $testimonial->quote) }}</textarea>
                                        </div>
                                        @error('quote')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="rating" class="col-sm-2 col-form-label">Rating</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-star"></i></span>
                                            <input type="number" name="rating" id="rating" class="form-control" value="{{ old('rating', $testimonial->rating) }}" min="1" max="5" step="1" required placeholder="Rating" />
                                        </div>
                                        @error('rating')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="sort_order" class="col-sm-2 col-form-label">Sort Order</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-sort"></i></span>
                                            <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $testimonial->sort_order) }}" min="0" max="999999" step="1" placeholder="Sort Order" />
                                        </div>
                                        @error('sort_order')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <x-logos.status name="status" :value="$testimonial->status" />
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
            if (!file) return;
            if (validateFile(file, 2, true)) {
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
