@extends('layout.adminapp')
@section('content')
    <div class="content-wrapper">
        @include('message')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">
                    <a href="{{ route('admin.info.index') }}" class="text-muted">Info Cards</a> /
                </span>
                {{ $info->exists ? 'Edit' : 'Add' }} Info Card
            </h4>
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">{{ $info->exists ? 'Edit' : 'Add' }} Info Card</h5>
                </div>
                <div class="card-body">
                    <form action="{{ $info->exists ? route('admin.info.update', $info->id) : route('admin.info.store') }}"
                        method="POST">
                        @csrf
                        @if ($info->exists)
                            @method('PUT')
                        @endif
                        <div class="row mb-3">
                            <label for="info-title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user" aria-hidden="true"></i></span>
                                    <input id="info-title" name="title" class="form-control"
                                        value="{{ old('title', $info->title) }}">
                                </div>
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="info-description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-text" aria-hidden="true"></i></span>
                                    <textarea id="info-description" name="description" class="form-control"
                                        rows="4">{{ old('description', $info->description) }}</textarea>
                                </div>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="info-icon" class="col-sm-2 col-form-label">Icon</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-image" aria-hidden="true"></i></span>
                                    <select id="info-icon" name="icon"
                                        class="form-select">
                                        @foreach ($icons as $value => $label)
                                        <option value="{{ $value }}" @selected(old('icon', $info->icon) === $value)>{{ $label }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('icon')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="info-order" class="col-sm-2 col-form-label">Display order</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-sort" aria-hidden="true"></i></span>
                                    <input id="info-order" type="number" name="sort_order"
                                        class="form-control"
                                        value="{{ old('sort_order', $info->sort_order) }}">
                                </div>
                                <small class="text-muted">Lower numbers appear first.</small>
                                @error('sort_order')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="info-status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-check-circle" aria-hidden="true"></i></span>
                                    <select id="info-status" name="status"
                                        class="form-select">
                                        <option value="1" @selected((string) old('status', (int) $info->status) === '1')>Active</option>
                                        <option value="0" @selected((string) old('status', (int) $info->status) === '0')>Inactive</option>
                                    </select>
                                </div>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button class="btn btn-primary"
                                    type="submit">{{ $info->exists ? 'Save Changes' : 'Create Card' }} <x-loader-icon /></button>
                                <a href="{{ route('admin.info.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
