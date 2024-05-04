<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use DB;
class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $author = DB::table('authors')->select('*')->get();
        return view('backend.author', compact('author'));
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
            'fullname' => 'required|string',
          
        ]);
        
        $author = new Author();
        $author->fullname = $request->fullname;
        $author->description = $request->description;
        $author->status = 0;
        
        if ($request->hasFile('profile_picture')) {
            $profile_picture = $request->file('profile_picture');
            $img_name = hexdec(uniqid()) . '.' . $profile_picture->getClientOriginalExtension();
            $profile_picture->move('uploads/authors/profilepicture/', $img_name);
            $save_url = '/uploads/authors/profilepicture/' . $img_name;
            $author->profile_picture = $save_url;
        }
        
        $author->save();
        
        return redirect()->back()->with('message', 'Your data has been saved successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author,$id)
    {
        {
            $author = DB::table('authors')->select('*')->get();
            $editAuthor = DB::table('authors')->select('*')->where('id',$id)->first();
            
            return view('backend.author', compact('author', 'editAuthor'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required|string',
            
        ]);
    
        $author = DB::table('authors')->where('id', $id)->first();
    
        $updateData = [
            'fullname' => $request->fullname,
            'description' => $request->description,
        ];
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $new_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/authors/profilepicture/', $new_image);
            $save_url = '/uploads/authors/profilepicture/' . $new_image;
            $updateData['profile_picture'] = $save_url;
        }
        DB::table('authors')->where('id', $id)->update($updateData);
        return redirect('/author')->with('message', 'Author updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author,$id)
    {
        {
            DB::table('authors')->where('id', $id)->delete();
        
            return redirect()->back()->with('success', 'Author deleted successfully.');
        }
    }
    public function hideAuthor(Request $request)
    {
        $imageId = $request->input('imageId');
        $enableValue = $request->input('enable', 0);
        Author::where('id', $imageId)->update(['status' => $enableValue]);
        return response()->json(['success' => true]);
    }
}