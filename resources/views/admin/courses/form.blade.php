@extends('layout.adminapp')
@section('content')
    <div class="content-wrapper">
        @include('message')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">{{ isset($course) ? 'Edit Course' : 'Add Course' }}</h4>
            <div class="card">
                <div class="card-body">
                    <form novalidate
                        action="{{ isset($course) ? route('admin.courses.update', $course->id) : route('admin.courses.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($course))
                            @method('PUT')
                        @endif
                        <div class="row">
                            @foreach (['category_id' => ['Category', $categories], 'subcategory_id' => ['Subcategory', $subcategories], 'instructor_id' => ['Instructor', $instructors]] as $field => [$label, $options])
                                <div class="col-md-4 mb-3">
                                    <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                                    <select id="{{ $field }}" name="{{ $field }}" class="form-select"
                                        required>
                                        <option value="">Select {{ $label }}</option>
                                        @foreach ($options as $option)
                                            <option value="{{ $option->id }}"
                                                @if ($field === 'subcategory_id') data-category="{{ $option->category_id }}" @endif
                                                @selected(old($field, $course->$field ?? '') == $option->id)>
                                                {{ $option->name }}{{ $field === 'instructor_id' ? ' (' . $option->email . ')' : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error($field)
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endforeach
                            @foreach (['course_title' => 'Course Title', 'course_slug' => 'Course Slug', 'course_name' => 'Course Name', 'video_url' => 'Video URL', 'label' => 'Level', 'resources' => 'Resources', 'certificate' => 'Certificate', 'selling_price' => 'Selling Price', 'discount_price' => 'Discount Price'] as $field => $label)
                                <div class="col-md-6 mb-3">
                                    <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                                    <input id="{{ $field }}" name="{{ $field }}" class="form-control"
                                        value="{{ old($field, $course->$field ?? '') }}"
                                        type="{{ str_ends_with($field, '_price') ? 'number' : ($field === 'video_url' ? 'url' : 'text') }}"
                                        @if (str_ends_with($field, '_price')) min="0" step="0.01" @else maxlength="{{ $field === 'label' ? 100 : 255 }}" @endif
                                        @required($field === 'course_title')>
                                    @error($field)
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endforeach
                            <div class="col-12 mb-3">
                                <label for="course_image" class="form-label">Course Image</label>
                                <x-course-image-input :image="$course->course_image ?? null" />
                                @error('course_image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="form-text">JPG, PNG or WebP, up to 2 MB. Leave empty to keep the current image.
                                </div>
                            </div>
                            @foreach (['course_description' => 'Description', 'prerequisites' => 'Prerequisites'] as $field => $label)
                                <div class="col-12 mb-3">
                                    <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                                    <textarea id="{{ $field }}" name="{{ $field }}" class="form-control" rows="4"
                                        @if ($field === 'prerequisites') maxlength="500" @endif>{{ old($field, $course->$field ?? '') }}</textarea>
                                    @error($field)
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endforeach
                            <div class="col-12 mb-3">
                                @foreach (['best_seller' => 'Best Seller', 'featured' => 'Featured', 'hightest_rated' => 'Highest Rated'] as $field => $label)
                                    <input type="hidden" name="{{ $field }}" value="0">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" id="{{ $field }}" name="{{ $field }}"
                                            value="1" class="form-check-input" @checked(old($field, $course->$field ?? 0) == 1)>
                                        <label for="{{ $field }}"
                                            class="form-check-label">{{ $label }}</label>
                                        @error($field)
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="1" @selected(old('status', $course->status ?? 1) == 1)>Active</option>
                                    <option value="0" @selected(old('status', $course->status ?? 1) == 0)>Inactive</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <button type="submit"
                            class="btn btn-primary">{{ isset($course) ? 'Update Course' : 'Save Course' }} <x-loader-icon /></button>
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/course-image-preview.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const category = document.getElementById('category_id');
            const subcategory = document.getElementById('subcategory_id');

            function filterSubcategories() {
                Array.from(subcategory.options).forEach(function(option) {
                    if (!option.value) return;
                    option.hidden = option.dataset.category !== category.value;
                    option.disabled = option.hidden;
                    if (option.hidden && option.selected) subcategory.value = '';
                });
            }
            category.addEventListener('change', filterSubcategories);
            filterSubcategories();
        });
    </script>
@endsection
