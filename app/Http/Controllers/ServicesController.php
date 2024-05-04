<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use DB;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $service = DB::table('services')->select('*')->get();
        return view('backend.service', compact('service'));
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
        'service_title' => 'required|string',
        'service_description' => 'required|string',
        'service_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $service = new Services();
    $service->service_title = $request->service_title;
    $service->service_description = $request->service_description;

    if ($request->hasFile('service_image')) {
        $service_image = $request->file('service_image');
        $img_name = hexdec(uniqid()) . '.' . $service_image->getClientOriginalExtension();
        $service_image->move('uploads/services/serviceimage/', $img_name);
        $save_url = '/uploads/services/serviceimage/' . $img_name;
        $service->service_image = $save_url;
    }

    $service->save();

    return redirect()->back()->with('message', 'Your data has been saved successfully');
}


    /**
     * Display the specified resource.
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Services $services,$id)
    {
        {
            $service = DB::table('services')->select('*')->get();
            $editService = DB::table('services')->select('*')->where('id',$id)->first();
            
            return view('backend.service', compact('service', 'editService'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, $id)
{
    $request->validate([
        'service_title' => 'required|string',
        'service_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'service_description' => 'required|string',
    ]);

    $service = DB::table('services')->where('id', $id)->first();

    $updateData = [
        'service_title' => $request->service_title,
        'service_description' => $request->service_description,
    ];
    if ($request->hasFile('service_image')) {
        $image = $request->file('service_image');
        $new_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move('uploads/services/serviceimage/', $new_image);
        $save_url = '/uploads/services/serviceimage/' . $new_image;
        $updateData['service_image'] = $save_url;
    }
    DB::table('services')->where('id', $id)->update($updateData);
    return redirect('/admin-services')->with('message', 'Service updated successfully.');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('services')->where('id', $id)->delete();
    
        return redirect()->back()->with('success', 'Service deleted successfully.');
    }
}