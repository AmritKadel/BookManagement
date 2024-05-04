<?php

namespace App\Http\Controllers;

use App\Models\SliderImages;
use Illuminate\Http\Request;
use DB;

class SliderImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliderImages = DB::table('slider_images')->select('*')->get();
        return view('backend.sliderimages', compact('sliderImages'));
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
            'caption' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $sliderImages = new SliderImages();
        $sliderImages->name = $request->name;
        $sliderImages->caption = $request->caption;
    
        if ($request->hasFile('image')) {
            $sliderImage = $request->file('image');
            $img_name = hexdec(uniqid()) . '.' . $sliderImage->getClientOriginalExtension();
            $sliderImage->move('uploads/sliderimages/', $img_name);
            $save_url = '/uploads/sliderimages/' . $img_name;
            $sliderImages->image = $save_url;
        }
    
        $sliderImages->save();
    
        return redirect()->back()->with('message', 'Your data has been saved successfully');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(SliderImages $sliderImages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SliderImages $sliderImages,$id)
    {
        {
            $sliderImages = DB::table('slider_images')->select('*')->get();
            $editsliderImages = DB::table('slider_images')->select('*')->where('id',$id)->first();
            
            return view('backend.sliderimages', compact('sliderImages', 'editsliderImages'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'required|string',
        ]);
    
        $sliderImages = DB::table('slider_images')->where('id', $id)->first();
    
        $updateData = [
            'name' => $request->name,
            'caption' => $request->caption,
        ];

        if ($request->hasFile('image')) {
            $sliderImage = $request->file('image');
            $img_name = hexdec(uniqid()) . '.' . $sliderImage->getClientOriginalExtension();
            $sliderImage->move('uploads/sliderimages/', $img_name);
            $save_url = '/uploads/sliderimages/' . $img_name;
            $updateData['image'] = $save_url;
        }
        DB::table('slider_images')->where('id', $id)->update($updateData);
        return redirect('/sliderimages')->with('message', 'Slider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('slider_images')->where('id', $id)->delete();
    
        return redirect()->back()->with('success', 'Images deleted successfully.');
    }
}