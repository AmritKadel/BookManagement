<?php

namespace App\Http\Controllers;

use App\Models\BookChildCategory;
use DB;
use Illuminate\Http\Request;

class BookChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookChildCategory = DB::table('book_child_categories')

            ->select('*')
            ->get();

        return view('backend.childcatagory', compact('bookChildCategory'));

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

            $bookChildCategory = new BookChildCategory();
            $bookChildCategory->child_title = $request->child_title;
            $bookChildCategory->book_cat_id = $request->book_cat_id;
            $bookChildCategory->book_sub_cat_id = $request->book_sub_cat_id;
            $bookChildCategory->display_order = $request->display_order;

            $bookChildCategory->save();
            return redirect()->back()->with('message', 'Your data has been saved successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BookChildCategory $bookChildCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookChildCategory $bookChildCategory, $id)
    {
        {
            $bookChildCategory = DB::table('book_child_categories')

                ->select('*')
                ->get();
            $editBookChildCatagory = DB::table('book_child_categories')

                ->select('*')
                ->where('book_child_categories.id', $id)
                ->first();
            return view('backend.childcatagory', compact('bookChildCategory', 'editBookChildCatagory'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $bookChildCategory = BookChildCategory::findOrFail($id);
        $bookChildCategory->child_title = $request->child_title;
        $bookChildCategory->book_cat_id = $request->book_cat_id;
        $bookChildCategory->book_sub_cat_id = $request->book_sub_cat_id;
        $bookChildCategory->display_order = $request->display_order;
        $bookChildCategory->save();

        return redirect('/childCatagory')->with('message', 'Your data has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookChildCategory $bookChildCategory, $id)
    {
        {
            DB::table('book_child_categories')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Book child catgeories deleted successfully.');
        }
    }
}
