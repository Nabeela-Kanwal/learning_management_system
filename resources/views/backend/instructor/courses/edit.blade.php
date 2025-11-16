@extends('layout.instructorapp')
@section('content')
    <div class="content-wrapper">
        @include('message')
        <div class="container-xxl flex-grow-1 container-p-y">

            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">
                    <a href="{{ route('instructor.course.index') }}" class="text-muted">Courses</a> /
                </span>
                Edit Course
            </h4>

            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit Course</h5>
                        </div>

                        <div class="card-body">

                            <form id="courseForm" action="{{ route('instructor.course.update', $course->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{-- Course Image --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Course Image</label>
                                    <div class="col-sm-10">
                                        <img id="previewImage"
                                            src="{{ $course->course_image ? asset($course->course_image) : asset('images/default-course.png') }}"
                                            style="max-width:150px;margin-bottom:10px;display:block;" />
                                        <input type="file" name="course_image" class="form-control"
                                            onchange="checkImage(this)" />
                                    </div>
                                </div>

                                {{-- Category --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $course->category_id == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Subcategory --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Subcategory</label>
                                    <div class="col-sm-10">
                                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                                            <option value="">Select Subcategory</option>
                                            @foreach ($subcategories as $sub)
                                                <option value="{{ $sub->id }}"
                                                    {{ $course->subcategory_id == $sub->id ? 'selected' : '' }}>
                                                    {{ $sub->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Instructor --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Instructor</label>
                                    <div class="col-sm-10">
                                        <select name="instructor_id" class="form-control">
                                            @foreach ($instructors as $ins)
                                                <option value="{{ $ins->id }}"
                                                    {{ $course->instructor_id == $ins->id ? 'selected' : '' }}>
                                                    {{ $ins->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Course Title --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Course Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="course_title" id="course_title" class="form-control"
                                            value="{{ $course->course_title }}" placeholder="Course Title" />
                                    </div>
                                </div>

                                {{-- Course Slug --}}
                                {{-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Course Slug</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="course_slug" id="course_slug" class="form-control"
                                            value="{{ $course->course_slug }}" placeholder="auto-generated slug" />
                                    </div>
                                </div> --}}

                                {{-- Course Name --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Course Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="course_name" class="form-control"
                                            value="{{ $course->course_name }}" placeholder="Displayed Name" />
                                    </div>
                                </div>


                                {{-- Description --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="course_description" class="form-control" rows="4">{{ $course->course_description }}</textarea>
                                    </div>
                                </div>

                                {{-- Video URL --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Video URL</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="video_url" class="form-control"
                                            value="{{ $course->video_url }}" placeholder="https://youtube.com/embed/...">
                                    </div>
                                </div>

                                {{-- Label --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Label</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="label" class="form-control"
                                            value="{{ $course->label }}">
                                    </div>
                                </div>

                                {{-- Resources --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Resources</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="resources" class="form-control"
                                            value="{{ $course->resources }}">
                                    </div>
                                </div>

                                {{-- Certificate --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Certificate</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="certificate" class="form-control"
                                            value="{{ $course->certificate }}">
                                    </div>
                                </div>

                                {{-- Prices --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Selling Price</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="selling_price" class="form-control"
                                            value="{{ $course->selling_price }}">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Discount Price</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="discount_price" class="form-control"
                                            value="{{ $course->discount_price }}">
                                    </div>
                                </div>

                                {{-- Prerequisites --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Prerequisites</label>
                                    <div class="col-sm-10">
                                        <textarea name="prerequisites" class="form-control" rows="3">{{ $course->prerequisites }}</textarea>
                                    </div>
                                </div>

                                {{-- Tags --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Tags</label>
                                    <div class="col-sm-10">

                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="best_seller" value="1"
                                                class="form-check-input" {{ $course->best_seller == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Best Seller</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="featured" value="1"
                                                class="form-check-input" {{ $course->featured == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Featured</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="hightest_rated" value="1"
                                                class="form-check-input"
                                                {{ $course->hightest_rated == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Highest Rated</label>
                                        </div>

                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select name="status" class="form-control">
                                            <option value="1" {{ $course->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $course->status == 0 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Submit --}}
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
        // Generate slug automatically
        $('#course_title').on('input', function() {
            let title = $(this).val();
            let slug = title.toLowerCase().trim().replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-');
            $('#course_slug').val(slug);
        });

        // Preview uploaded image
        function checkImage(input) {
            var file = input.files[0];
            if (!file) return;

            var preview = document.getElementById('previewImage');
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    </script>
@endsection
