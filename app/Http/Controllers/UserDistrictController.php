<?php

namespace App\Http\Controllers;

use App\Models\UserDistrict;
use Illuminate\Http\Request;
use DB;

class UserDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userDistrict = DB::table('user_districts')->select('*')->get();
        return view('backend.userdistrict', compact('userDistrict'));
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
            'title' => 'required|string',

        ]);
        $userDistrict = new UserDistrict();
        $userDistrict->title = $request->title;
        $userDistrict->description = $request->description;
        $userDistrict->save();
        return redirect()->back()->with('message', 'Your data has been saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserDistrict $userDistrict)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserDistrict $userDistrict)
    {
        $userDistrict = DB::table('user_districts')->select('*')->get();
        $edituserDistrict = DB::table('user_districts')->select('*')->first();
        return view('backend.userdistrict', compact('edituserDistrict', 'userDistrict'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserDistrict $userDistrict,$id)
    {
        {
            $request->validate([
                'title' => 'required',
            ]);

            $userDistrict = UserDistrict::findOrFail($id);
            $userDistrict->title = $request->title;
            $userDistrict->description = $request->description;
            $userDistrict->save();

            return redirect('/userdistrict')->with('message', 'Your data has been updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDistrict $userDistrict, $id)
    {
        {
            DB::table('user_districts')->where('id', $id)->delete();

            return redirect()->back()->with('message', 'User District has been deleted successfully.');
        }
    }
}