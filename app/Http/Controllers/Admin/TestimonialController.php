<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        return view('admin.testimonial.index', ['testimonials' => Testimonial::orderBy('sort_order')->orderByDesc('id')->paginate(15)]);
    }

    public function create()
    {
        return view('admin.testimonial.form', ['testimonial' => new Testimonial(['role' => 'Student', 'rating' => 5, 'sort_order' => 0, 'status' => false])]);
    }

    public function store(TestimonialRequest $request)
    {
        $this->save($request, new Testimonial);
        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.form', compact('testimonial'));
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        $this->save($request, $testimonial);
        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial updated successfully.');
    }

    private function save(TestimonialRequest $request, Testimonial $testimonial): void
    {
        $data = $request->safe()->except(['image', 'remove_image']);
        $oldImage = $testimonial->image;
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonials', 'public');
            abort_unless($data['image'], 500, 'Unable to save the portrait. Please try again.');
        } elseif ($request->boolean('remove_image')) {
            $data['image'] = null;
        }
        $testimonial->fill($data)->save();
        if ($oldImage && $oldImage !== $testimonial->image) {
            Storage::disk('public')->delete($oldImage);
        }
    }

    public function destroy(Testimonial $testimonial)
    {
        $image = $testimonial->image;
        $testimonial->delete();
        if ($image) {
            Storage::disk('public')->delete($image);
        }
        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial deleted successfully.');
    }
}
