<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use Illuminate\Http\Request;
use DB;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookCategory = DB::table('book_categories')->select('*')->get();
        return view('backend.catagory', compact('bookCategory'));
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

    $bookCategory = new BookCategory();
    $bookCategory->title = $request->title;
    $bookCategory->display_order = $request->display_order;
    $bookCategory->save();
    return redirect()->back()->with('message', 'Your data has been saved successfully');
}

    /**
     * Display the specified resource.
     */
    public function show(BookCategory $bookCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookCategory $bookCategory,$id)
    {
        $bookCategory = DB::table('book_categories')->select('*')->get();
        $editbookCategory = DB::table('book_categories')->select('*')->where('id',$id)->first();
        return view('backend.catagory', compact('bookCategory', 'editbookCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required',
    ]);

    $bookCategory = BookCategory::findOrFail($id);
    $bookCategory->title = $request->title;
    $bookCategory->save();

    return redirect('/catagory')->with('message', 'Your data has been updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookCategory $bookCategory,$id)
    {
        {
            DB::table('book_categories')->where('id', $id)->delete();
        
            return redirect()->back()->with('success', 'Book catgeories deleted successfully.');
        }
    }
}