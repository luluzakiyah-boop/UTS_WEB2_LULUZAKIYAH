<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialManagementController extends Controller
{
    public function index()
    {
        return view('admin.testimonials.index', ['testimonials' => Testimonial::latest()->paginate(10)]);
    }

    public function create()
    {
        return view('admin.testimonials.form', ['testimonial' => null]);
    }

    public function store(Request $request)
    {
        Testimonial::create($this->validateTestimonial($request));

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $testimonial->update($this->validateTestimonial($request));

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return back()->with('success', 'Testimoni berhasil dihapus.');
    }

    private function validateTestimonial(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'profession' => ['nullable', 'string', 'max:100'],
            'message' => ['required', 'string', 'min:10', 'max:1000'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
        ]);
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
