<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminUser $adminUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminUser $adminUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminUser $adminUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminUser $adminUser)
    {
        //
    }
    public function createAdmin(Request $request)
    {
        /** check if admin user is already generated */
        $checkUser = AdminUser::where('email', 'admin@alliedpublication.com')->first();
        if ($checkUser) {
            return response()->json(['error' => 'Admin Account Already Exists'], 200);
        }

        $admin = new AdminUser;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $adminPassword = $request->password; // Set the password here
        $admin->password = Hash::make($adminPassword);
        $status = $admin->save();
        $request->session()->put('sessionAdminPassword', $adminPassword);

        return redirect('/adminlogin')->with('sucess', 'Admin has been registered successfully');
    }
    public function loginAdmin(Request $request)
    {
        {
            $request->validate([
                'useremail' => 'required|email',
                'userpassword' => 'required',
            ]);

            $email = $request->useremail;
            $password = $request->userpassword;

            $user = AdminUser::where('email', $email)->first();

            if ($user) {
                if (Hash::check($password, $user->password)) {
                    $request->session()->put('sessionAdminPassword', $user->password);
                    $request->session()->save();
                    return redirect('/admin-dashboard');
                } else {
                  
                    return redirect()->back()->with('success', 'Your password is incorrect');
                }
            } else {
               
                return redirect()->back()->with('success', 'Your email is incorrect');
            }
        }

    }
    public function updatePassword(Request $request)
    

    {
       
        $request->validate([
            'password' => 'required|min:6',
        ]);

        $user = AdminUser::where('password', session()->get('sessionAdminPassword'))->first();
        if (!$user) {
            return redirect()->back()->with('success', 'User not found');
        }

        if (Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('success', 'Old password cannot be your new password');
        }

        $user->password = Hash::make($request->password);
        $user->save();
        $request->session()->put('sessionAdminPassword', $user->password);

        return redirect()->back()->with('success', 'Your password has been changed successfully');
    }
}