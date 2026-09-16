@props(['image' => null])

<div data-course-image-input>
    <div data-image-preview @if (!$image) hidden @endif>
        <img @if ($image) src="{{ asset($image) }}" @endif
            alt="Course image preview" class="rounded mb-2"
            style="max-width: 180px; max-height: 180px; object-fit: contain;">
    </div>
    <input type="file" id="course_image" name="course_image" class="form-control"
        accept="image/jpeg,image/png,image/webp" aria-describedby="course_image_error">
    <small id="course_image_error" class="text-danger" role="alert" hidden></small>
</div>
