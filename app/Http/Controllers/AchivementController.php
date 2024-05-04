<?php

namespace App\Http\Controllers;

use App\Models\Achivement;
use Illuminate\Http\Request;
use DB;

class AchivementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achivement = DB::table('achivements')->select('*')->get();
       
        return view('backend.achievement', compact('achivement'));
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
                'title' => 'required',
                'description' => 'required',
               
            ]);
    
            $achivement = new Achivement();
            $achivement->title = $request->title;
            $achivement->description = $request->description;
            $achivement->save();
    
            return redirect()->back()->with('message', 'Data has been saved successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Achivement $achivement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Achivement $achivement, $id)
    {
        {
            $achivement = DB::table('achivements')->select('*')->get();
            $editAchivement = DB::table('achivements')->select('*')->where('id',$id)->first();
           
            return view('backend.achievement', compact('achivement','editAchivement'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Achivement $achivement, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
           
        ]);
        $achivement = Achivement::findOrFail($id);
        $achivement->title = $request->title;
        $achivement->description = $request->description;
        $achivement->save();
        return redirect('/achievement')->with('message', 'Data has been updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achivement $achivement, $id)
    {
        {
            DB::table('achivements')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Data deleted successfully.');
        }
    }
}