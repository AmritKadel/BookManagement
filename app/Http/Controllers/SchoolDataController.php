<?php

namespace App\Http\Controllers;

use App\Models\SchoolData;
use App\Models\ContactUsForm;
use DB;
use Illuminate\Http\Request;

class SchoolDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('school_data')->select('*');
        if ($request->filled('name')) {
            $name = $request->input('name');
            $query->where('school_data.name', 'like', '%' . $name . '%');
        }
        $data = $query->paginate(10);
        return view('backend.addschooldata', compact('data'));
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
                'name' => 'required|string',
                'district' => 'required|string',
                'address' => 'required|string',
                'contact_number' => 'required|string',
                'principal_name' => 'required|string',

    
            ]);
            $schoolData = new SchoolData();
            $schoolData->name = $request->name;
            $schoolData->district = $request->district;
            $schoolData->address = $request->address;
            $schoolData->contact_number = $request->contact_number;
            $schoolData->principal_name = $request->principal_name;
            $schoolData->save();
            return redirect()->back()->with('message', 'School created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolData $schoolData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolData $schoolData, $id)
    {
        {
            $data = DB::table('school_data')->select('*')->get();
            $editSchooldata = DB::table('school_data')->select('*')->where('id',$id)->first();
           
            return view('backend.addschooldata', compact('data','editSchooldata'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolData $schoolData, $id)
    {
        $schoolData = SchoolData::find($id);
        $schoolData->name = $request->name;
        $schoolData->district = $request->district;
        $schoolData->address = $request->address;
        $schoolData->contact_number = $request->contact_number;
        $schoolData->principal_name = $request->principal_name;
        $schoolData->save();
        return redirect('/addschooldata')->with('message', 'School data updated  successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolData $schoolData)
    {
        //
    }
    public function updateContactUsData(Request $request, ContactUsForm $schoolData, $id)
    {

        $schoolData = ContactUsForm::find($id);
        $schoolData->status = $request->status;
        $schoolData->save();

        return redirect('/admin-dashboard')->with('message', 'School data updated  successfully');
        
    }

}