<?php

namespace App\Http\Controllers;

use App\Models\Testimonials;
use DB;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            $testimonials = DB::table('testimonials')->select('*')->get();
            return view('backend.reviews', compact('testimonials'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'designation' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $testimonial = new Testimonials();
        $testimonial->name = $request->name;
        $testimonial->description = $request->description;
        $testimonial->designation = $request->designation;

        if ($request->hasFile('image')) {
            $testimonialImage = $request->file('image');
            $img_name = hexdec(uniqid()) . '.' . $testimonialImage->getClientOriginalExtension();
            $testimonialImage->move('uploads/testimonialimages/', $img_name);
            $save_url = '/uploads/testimonialimages/' . $img_name;
            $testimonial->image = $save_url;
        }

        $testimonial->save();

        return redirect()->back()->with('message', 'Your data has been saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonials $testimonials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonials $testimonials, $id)
    {
        {
            $testimonials = DB::table('testimonials')->select('*')->get();
            $editTestimonials = DB::table('testimonials')->select('*')->where('id', $id)->first();

            return view('backend.reviews', compact('testimonials', 'editTestimonials'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonials $testimonials, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'designation' => 'required|string',
            'description' => 'required|string',
        ]);

        $testimonials = DB::table('testimonials')->where('id', $id)->first();

        $updateData = [
            'name' => $request->name,
            'designation' => $request->designation,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $testimonialsImage = $request->file('image');
            $img_name = hexdec(uniqid()) . '.' . $testimonialsImage->getClientOriginalExtension();
            $testimonialsImage->move('uploads/testimonials/', $img_name);
            $testimonialsImage = '/uploads/testimonials/' . $img_name;
            $updateData['image'] = $testimonialsImage;
        }

        DB::table('testimonials')->where('id', $id)->update($updateData);
        return redirect('/reviews')->with('message', 'Reviews updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonials $testimonials, $id)
    {
        {
            DB::table('testimonials')->where('id', $id)->delete();

            return redirect()->back()->with('message', 'Reviews deleted successfully.');
        }
    }
}
