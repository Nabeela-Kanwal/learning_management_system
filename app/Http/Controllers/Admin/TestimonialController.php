<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use App\Services\TestimonialService;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    protected $TestimonialService;

    public function __construct(TestimonialService $TestimonialService)
    {
        $this->TestimonialService = $TestimonialService;
    }

    public function index()
    {
        return view('admin.testimonial.index');
    }

    public function create()
    {
        return view('admin.testimonial.create');
    }

    public function store(TestimonialRequest $request)
    {
        $this->TestimonialService->saveTestimonial($request->validated(), $request->file('image'));

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial created successfully.');
    }

    public function update(TestimonialRequest $request, string $id)
    {
        $this->TestimonialService->updateTestimonial($id, $request->validated(), $request->file('image'));

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial updated successfully.');
    }

    public function edit(string $id)
    {
        $Testimonial = Testimonial::findOrFail($id);

        return view('admin.testimonial.edit', compact('Testimonial'));
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $Testimonial = Testimonial::findOrFail($id);
        $Testimonial->delete();

        return view('admin.testimonial.index');
    }
}
