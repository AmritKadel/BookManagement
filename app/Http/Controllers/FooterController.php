<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;
use DB;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footer = DB::table('footers')->select('*')->get();
       
        return view('backend.footer', compact('footer'));
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
            'location' => 'required|string',
            'description' => 'required|string',
            'phone_number' => 'required|numeric',
            'mail' => 'required|email',
            'website_link' => 'required|url',
        ]);

        $store = new Footer();
        $store->location = $request->location;
        $store->description = $request->description;
        $store->phone_number = $request->phone_number;
        $store->mail = $request->mail;
        $store->website_link = $request->website_link;
        $store->google_map = $request->google_map;
        $store->save();

        return redirect()->back()->with('message', 'Data has been saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Footer $footer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Footer $footer,$id)
    {
        {
            $footer = DB::table('footers')->select('*')->get();
            $editfooters = DB::table('footers')->select('*')->where('id',$id)->first();
           
            return view('backend.footer', compact('footer','editfooters'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'location' => 'required|string',
        'description' => 'required|string',
        'phone_number' => 'required|numeric',
        'mail' => 'required|email',
        'website_link' => 'required|url',
    ]);

    $store = Footer::findOrFail($id);
    $store->location = $request->location;
    $store->description = $request->description;
    $store->phone_number = $request->phone_number;
    $store->mail = $request->mail;
    $store->website_link = $request->website_link;
    $store->google_map = $request->google_map;
    $store->save();

    return redirect('/footers')->with('message', 'Data has been updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Footer $footer,$id)
    {
        {
            DB::table('footers')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Footers deleted successfully.');
        }
    }
}
