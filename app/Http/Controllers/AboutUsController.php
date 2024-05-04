<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use DB;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aboutus = DB::table('about_us')->select('*')->get();
       
        return view('backend.aboutus', compact('aboutus'));
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
            'title' => 'required',
            'description' => 'required',
           
        ]);

        $aboutUs = new AboutUs();
        $aboutUs->title = $request->title;
        $aboutUs->description = $request->description;
        $aboutUs->save();
        if ($request->hasFile('image')) {
            $about_image = $request->file('image');
            $img_name = hexdec(uniqid()) . '.' . $about_image->getClientOriginalExtension();
            $about_image->move('uploads/aboutus/', $img_name);
            $save_url = '/uploads/aboutus/' . $img_name;
            $aboutUs->about_image = $save_url;
        }
        return redirect()->back()->with('message', 'Data has been saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutUs $aboutUs, $id)
    {
        {
            $aboutus = DB::table('about_us')->select('*')->get();
            $editAboutUs = DB::table('about_us')->select('*')->where('id',$id)->first();
           
            return view('backend.aboutus', compact('aboutus','editAboutUs'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutUs $aboutUs, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
           
        ]);
    
        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->title = $request->title;
        $aboutUs->description = $request->description;
        if ($request->hasFile('image')) {
            $about_image = $request->file('image');
            $img_name = hexdec(uniqid()) . '.' . $about_image->getClientOriginalExtension();
            $about_image->move('uploads/aboutus/', $img_name);
            $save_url = '/uploads/aboutus/' . $img_name;
            $aboutUs->image = $save_url;
        }
        $aboutUs->save();
        return redirect('/aboutusdashboard')->with('message', 'Data has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutUs $aboutUs, $id)
    {
        {
            DB::table('about_us')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Data deleted successfully.');
        }
    }
}
