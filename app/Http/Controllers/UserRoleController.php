<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use DB;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userRole = DB::table('user_roles')->select('*')->get();
        return view('backend.userrole', compact('userRole'));
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
        $userRole = new UserRole();
        $userRole->title = $request->title;
        $userRole->description = $request->description;
        $userRole->save();
        return redirect()->back()->with('message', 'Your data has been saved successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(UserRole $userRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserRole $userRole)
    {
        $userRole = DB::table('user_roles')->select('*')->get();
        $edituserRole = DB::table('user_roles')->select('*')->first();
        return view('backend.userrole', compact('edituserRole', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserRole $userRole,$id)
    {
        {
            $request->validate([
                'title' => 'required',
            ]);

            $userRole = UserRole::findOrFail($id);
            $userRole->title = $request->title;
            $userRole->description = $request->description;
            $userRole->save();

            return redirect('/userrole')->with('message', 'Your data has been updated successfully');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserRole $userRole, $id)
    {
        {
            DB::table('user_roles')->where('id', $id)->delete();

            return redirect()->back()->with('message', 'User Role has been deleted successfully.');
        }
    }
}
