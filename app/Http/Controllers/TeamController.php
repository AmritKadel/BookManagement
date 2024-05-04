<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use DB;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            $teams = DB::table('teams')->select('*')->get();
            return view('backend.team', compact('teams'));
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
            'position' => 'required|string',
            'contact_number' => 'required|numeric',
        ]);
        
        $member = new Team();
        $member->name = $request->name;
        $member->position = $request->position;
        $member->contact_number = $request->contact_number;
        if ($request->hasFile('profile_picture')) {
            $profile_picture = $request->file('profile_picture');
            $img_name = hexdec(uniqid()) . '.' . $profile_picture->getClientOriginalExtension();
            $profile_picture->move('uploads/teams/', $img_name);
            $save_url = '/uploads/teams/' . $img_name;
            $member->profile_picture = $save_url;
        }
        $member->save();
    
        return redirect()->back()->with('message', 'Data has been saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team,$id)
    {
        {
            $teams = DB::table('teams')->select('*')->get();
            $editTeam = DB::table('teams')->select('*')->where('id',$id)->first();
            
            return view('backend.team', compact('teams', 'editTeam'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)

{
    
    $request->validate([
        'name' => 'required|string',
        'position' => 'required|string',
        'contact_number' => 'required|numeric',
    ]);
    
    $member = Team::findOrFail($id);
    $member->name = $request->name;
    $member->position = $request->position;
    $member->contact_number = $request->contact_number;

    if ($request->hasFile('profile_picture')) {
        $profile_picture = $request->file('profile_picture');
        $img_name = hexdec(uniqid()) . '.' . $profile_picture->getClientOriginalExtension();
        $profile_picture->move('uploads/teams/', $img_name);
        $save_url = '/uploads/teams/' . $img_name;
        $member->profile_picture = $save_url;
    }

    $member->save();

    return redirect('/teams')->with('message', 'Data has been updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team, $id)
    {
        {
            DB::table('teams')->where('id', $id)->delete();
        
            return redirect()->back()->with('success', 'Team details deleted successfully.');
        }
    }
}