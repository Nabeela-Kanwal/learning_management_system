@extends('layout.adminapp')

@section('content')
    <div class="content-wrapper">
        @include('message')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">
                    <a href="{{ route('admin.blog.index') }}" class="text-muted">Blogs</a> /
                </span>
                Edit Blog
            </h4>

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit Blog</h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

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
                                        @if ($blog->image)
                                            <img id="previewImage" src="{{ asset($blog->image) }}" alt="Image Preview"
                                                style="max-width: 180px; margin-top: 10px; display: block;" />
                                        @else
                                            <img id="previewImage" src="#" alt="Image Preview"
                                                style="max-width: 180px; margin-top: 10px; display: none;" />
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-heading"></i></span>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ old('title', $blog->title) }}" placeholder="Blog title"
                                                required />
                                        </div>
                                        @error('title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Slug</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-link"></i></span>
                                            <input type="text" name="slug" class="form-control"
                                                value="{{ old('slug', $blog->slug) }}" placeholder="Optional custom slug" />
                                        </div>
                                        @error('slug')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Author</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                                            <input type="text" name="author" class="form-control"
                                                value="{{ old('author', $blog->author) }}" placeholder="Author name" />
                                        </div>
                                        @error('author')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Publish Date</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                            <input type="date" name="published_at" class="form-control"
                                                value="{{ old('published_at', $blog->published_at?->format('Y-m-d')) }}" />
                                        </div>
                                        @error('published_at')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Short Description</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-text"></i></span>
                                            <textarea name="short_description" class="form-control" rows="3" placeholder="Short summary">{{ old('short_description', $blog->short_description) }}</textarea>
                                        </div>
                                        @error('short_description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-detail"></i></span>
                                            <textarea name="description" class="form-control" rows="8" placeholder="Blog content" required>{{ old('description', $blog->description) }}</textarea>
                                        </div>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <x-logos.status name="status" :value="$blog->status" />
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button class="btn btn-primary" type="submit">
                                            Update <x-loader-icon />
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
        function checkImage(input) {
            var file = input.files[0];
            if (file && validateFile(file, 2, true)) {
                var imagePreview = document.getElementById("previewImage");
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.style.display = 'block';
            } else if (file) {
                input.value = '';
                alert('Invalid file. Only images up to 2MB are allowed.');
            }
        }

        function validateFile(file, maxSizeMB = 2, onlyImage = true) {
            var validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
            var maxSizeBytes = maxSizeMB * 1024 * 1024;

            return (!onlyImage || validTypes.includes(file.type)) && file.size <= maxSizeBytes;
        }
    </script>
@endsection
