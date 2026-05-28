@extends('layout.instructorapp')
@section('content')
    <div class="content-wrapper">
        @include('message')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">
                    <a href="{{ route('instructor.course.index') }}" class="text-muted">Courses</a> /
                </span>
                Add Course
            </h4>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Add Course</h5>
                        </div>
                        <div class="card-body">
                            <form id="courseForm" action="{{ route('instructor.course.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- Category --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Subcategory --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Subcategory</label>
                                    <div class="col-sm-10">
                                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                                            <option value="">Select Subcategory</option>
                                            @foreach ($subcategories as $sub)
                                                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('subcategory_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Instructor --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Instructor</label>
                                    <div class="col-sm-10">
                                        <select name="instructor_id" id="instructor_id" class="form-control">
                                            <option value="">Select Instructor</option>
                                            @foreach ($instructors as $ins)
                                                <option value="{{ $ins->id }}">{{ $ins->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('instructor_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Course Title --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Course Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="course_title" id="course_title" class="form-control"
                                            value="{{ old('course_title') }}" placeholder="Course Title" />
                                        @error('course_title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Course Slug --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Course Slug</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="course_slug" id="course_slug" class="form-control"
                                            value="{{ old('course_slug') }}" placeholder="auto-generated slug" />
                                        @error('course_slug')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Course Name --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Course Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="course_name" id="course_name" class="form-control"
                                            value="{{ old('course_name') }}" placeholder="Displayed Name" />
                                        @error('course_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Course Image --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Course Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="course_image" class="form-control"
                                            onchange="checkImage(this)" />
                                        @error('course_image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <img id="previewImage" src="#" alt="Image Preview"
                                            style="max-width:150px;margin-top:10px;display:none;" />
                                    </div>
                                </div>

                                {{-- Description --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="course_description" class="form-control" rows="4" placeholder="Write about the course">{{ old('course_description') }}</textarea>
                                        @error('course_description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Video URL --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Video URL</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="video_url" class="form-control"
                                            value="{{ old('video_url') }}"
                                            placeholder="e.g. https://youtube.com/embed/..." />
                                    </div>
                                </div>

                                {{-- Label, Resources, Certificate --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Label</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="label" class="form-control"
                                            value="{{ old('label') }}" placeholder="e.g. Beginner, Advanced" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Resources</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="resources" class="form-control"
                                            value="{{ old('resources') }}" placeholder="Resources link or file name" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Certificate</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="certificate" class="form-control"
                                            value="{{ old('certificate') }}" placeholder="Certificate name or link" />
                                    </div>
                                </div>

                                {{-- Prices --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Selling Price</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="selling_price" class="form-control"
                                            value="{{ old('selling_price') }}" placeholder="e.g. 199.00" />
                                    </div>

                                    <label class="col-sm-2 col-form-label">Discount Price</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="discount_price" class="form-control"
                                            value="{{ old('discount_price') }}" placeholder="e.g. 99.00" />
                                    </div>
                                </div>

                                {{-- Prerequisites --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Prerequisites</label>
                                    <div class="col-sm-10">
                                        <textarea name="prerequisites" class="form-control" rows="3">{{ old('prerequisites') }}</textarea>
                                    </div>
                                </div>

                                {{-- Tags (checkboxes) --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Tags</label>
                                    <div class="col-sm-10">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="best_seller"
                                                value="1" />
                                            <label class="form-check-label">Best Seller</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="featured"
                                                value="1" />
                                            <label class="form-check-label">Featured</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="hightest_rated"
                                                value="1" />
                                            <label class="form-check-label">Highest Rated</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select name="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button class="btn btn-primary" type="submit">
                                            Save <x-loader-icon />
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
            // Slug auto-generation
            $('#course_title').on('input', function() {
                var title = $(this).val();
                var slug = title
                    .toLowerCase()
                    .trim()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-');
                $('#course_slug').val(slug);
            });
        });

        // Image preview
        function checkImage(input) {
            var file = input.files[0];
            if (file && validateFile(file, 2)) {
                var preview = document.getElementById('previewImage');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                alert('Only image files up to 2MB are allowed');
                input.value = '';
            }
        }

        function validateFile(file, maxMB) {
            const types = ['image/jpeg', 'image/png', 'image/webp'];
            return types.includes(file.type) && file.size <= maxMB * 1024 * 1024;
        }
    </script>
@endsection
