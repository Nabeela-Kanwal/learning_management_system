<?php

namespace App\Services;

use App\Models\Testimonial;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class TestimonialService
{
    public function saveTestimonial(array $data, ?UploadedFile $image = null): Testimonial
    {
        unset($data['image'], $data['remove_image']);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        if ($image && $image->isValid()) {
            $data['image'] = upload_image($image, 'images/testimonial');
        }

        return Testimonial::create($data);
    }

    public function updateTestimonial(string $id, array $data, ?UploadedFile $image = null): Testimonial
    {
        $testimonial = Testimonial::findOrFail($id);
        $oldImage = $testimonial->image;
        $removeImage = ! empty($data['remove_image']);
        unset($data['image'], $data['remove_image']);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        if ($image && $image->isValid()) {
            $data['image'] = upload_image($image, 'images/testimonial');
        } elseif ($removeImage) {
            $data['image'] = null;
        }
        $testimonial->update($data);
        if ($oldImage && ($image || $removeImage)) {
            $this->deleteImage($oldImage);
        }

        return $testimonial;
    }

    public function deleteTestimonial(Testimonial $testimonial): void
    {
        $testimonial->delete();
        if ($testimonial->image) {
            $this->deleteImage($testimonial->image);
        }
    }
    private function deleteImage(string $path): void
    {
        if (str_starts_with($path, 'images/testimonial/')) {
            File::delete(public_path($path));
        } elseif (str_starts_with($path, 'testimonials/')) {
            Storage::disk('public')->delete($path);
        }
    }
}
