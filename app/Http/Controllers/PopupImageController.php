<?php

namespace App\Http\Controllers;

use App\Models\PopupImage;
use Illuminate\Http\Request;
use DB;

class PopupImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            $popupImage = DB::table('popup_image')->select('*')->get();
           
            return view('backend.popupimage', compact('popupImage'));
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
        {
       
            $request->validate([
                'name' => 'required',
                'image' => 'required',
                'url' => 'required',
                
            ]);
            
            $popupImage = new PopupImage();
            $popupImage->name = $request->name;
            $popupImage->url = $request->url;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move('uploads/popupimage/', $img_name);
                $save_url = '/uploads/popupimage/' . $img_name;
                $popupImage->image = $save_url;
            }
            $popupImage->save();
        
            return redirect()->back()->with('message', 'Data has been saved successfully');
        }
    }

    public function enablepopup(Request $request)
    {
        $imageId = $request->input('imageId');
        $enableValue = $request->input('enable', 0); 
        PopupImage::where('id', $imageId)->update(['enable' => $enableValue]);
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PopupImage $popupImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PopupImage $popupImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PopupImage $popupImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PopupImage $popupImage, $id)
    {
        {
            DB::table('popup_image')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'PopupImage deleted successfully.');
        }
    }
}