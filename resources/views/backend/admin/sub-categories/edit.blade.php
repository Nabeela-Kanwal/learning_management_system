@extends('layout.adminapp')

@section('content')
    <div class="content-wrapper">
        @include('message')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">
                    <a href="{{ route('admin.sub-category.index') }}" class="text-muted">Sub Categories</a> /
                </span>
                Edit Sub Category
            </h4>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit Sub Category</h5>
                        </div>
                        <div class="card-body">
                            <form id="categoryForm" action="{{ route('admin.sub-category.update', $category->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                {{-- Name --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ old('name', $category->name) }}" placeholder="Category Name" />
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
                                                value="{{ old('slug', $category->slug) }}" placeholder="slug" />
                                        </div>
                                        @error('slug')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Category Dropdown --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label custom-label">Category</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bx bx-category"></i></span>
                                            <select name="category_id" class="form-select custom-dropdown">
                                                <option value="">Select a category</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        {{ old('category_id', $category->category_id) == $cat->id ? 'selected' : '' }}>
                                                        {{ $cat->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button class="btn btn-primary" type="submit" id="submitBtn">
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
    </script>
@endsection
