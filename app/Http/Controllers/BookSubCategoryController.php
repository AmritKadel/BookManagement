<?php

namespace App\Http\Controllers;

use App\Models\BookSubCategory;
use DB;
use Illuminate\Http\Request;

class BookSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookSubCategory = DB::table('book_sub_categories')
           
            ->select('*')
            ->get();

        return view('backend.subcategory', compact('bookSubCategory'));

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

            

            $bookSubCategory = new BookSubCategory();
            $bookSubCategory->sub_title = $request->sub_title;
            $bookSubCategory->book_cat_id = $request->book_cat_id;
            $bookSubCategory->display_order = $request->display_order;
            $bookSubCategory->save();
            return redirect()->back()->with('message', 'Your data has been saved successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BookSubCategory $bookSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookSubCategory $bookSubCategory,$id)
    {
        {
            $bookSubCategory = DB::table('book_sub_categories')
            
            ->select('*')
            ->get();
            $editbookSubCategory = DB::table('book_sub_categories')
            
            ->select('*')
            ->where('book_sub_categories.id',$id)
            ->first();
            return view('backend.subcategory', compact('bookSubCategory', 'editbookSubCategory'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookSubCategory $bookSubCategory,$id)
    {
        {
            
           
            
            $bookSubCategory = BookSubCategory::findOrFail($id);
            $bookSubCategory->sub_title = $request->sub_title;
            $bookSubCategory->book_cat_id = $request->cat_id;
            $bookSubCategory->display_order = $request->display_order;
            $bookSubCategory->save();
            return redirect('/subCatagory')->with('message', 'Your data has been updated successfully');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookSubCategory $bookSubCategory,$id)
    {
        {
            DB::table('book_sub_categories')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Book sub catgeories deleted successfully.');
        }
    }
}