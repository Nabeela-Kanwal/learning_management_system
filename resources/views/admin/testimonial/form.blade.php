@extends('layout.adminapp')
@section('content')
<div class="content-wrapper"><div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3">{{ $testimonial->exists ? 'Edit' : 'Add' }} testimonial</h4>
    <div class="card"><div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{ $testimonial->exists ? route('admin.testimonial.update', $testimonial) : route('admin.testimonial.store') }}">
            @csrf
            @if($testimonial->exists) @method('PUT') @endif
            @foreach(['name' => 'Name', 'role' => 'Role or course', 'rating' => 'Rating (1–5)', 'sort_order' => 'Display order'] as $field => $label)
                <div class="mb-3">
                    <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                    <input id="{{ $field }}" name="{{ $field }}" class="form-control" value="{{ old($field, $testimonial->$field) }}" required
                        @if(in_array($field, ['rating', 'sort_order'])) type="number" min="{{ $field === 'rating' ? 1 : 0 }}" max="{{ $field === 'rating' ? 5 : 999999 }}" @else type="text" maxlength="120" @endif>
                    @error($field)<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            @endforeach
            <div class="mb-3">
                <label for="quote" class="form-label">Feedback</label>
                <textarea id="quote" name="quote" class="form-control" rows="5" maxlength="2000" required>{{ old('quote', $testimonial->quote) }}</textarea>
                @error('quote')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Portrait (optional, JPG, PNG or WebP, up to 2 MB)</label>
                <input id="image" type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
                @error('image')<div class="text-danger">{{ $message }}</div>@enderror
                @if($testimonial->image)
                    <img src="{{ Storage::disk('public')->url($testimonial->image) }}" alt="Current portrait" width="80" height="80" class="rounded mt-2" style="object-fit:cover">
                    <label class="d-block mt-2"><input type="checkbox" name="remove_image" value="1" @checked(old('remove_image'))> Remove portrait</label>
                @endif
                @error('remove_image')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select">
                    <option value="0" @selected(!old('status', $testimonial->status))>Draft</option>
                    <option value="1" @selected(old('status', $testimonial->status))>Published</option>
                </select>
                @error('status')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <button class="btn btn-primary" type="submit">Save testimonial</button>
            <a href="{{ route('admin.testimonial.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div></div>
</div></div>
@endsection
