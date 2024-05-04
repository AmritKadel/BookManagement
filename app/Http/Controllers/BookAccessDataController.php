<?php

namespace App\Http\Controllers;

use App\Models\BookAccessData;
use DB;
use Illuminate\Http\Request;

class BookAccessDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('book_access_data')
            ->join('books', 'book_access_data.book_id', '=', 'books.id')
            ->join('public_users', 'book_access_data.user_id', '=', 'public_users.id')
            ->select('book_access_data.*', 'books.*', 'public_users.*');

        if ($request->filled('fullname')) {
            $fullname = $request->input('fullname');
            $query->where('public_users.name', 'like', '%' . $fullname . '%');
        }

        $usageRecords = $query->paginate(10);
        return view('backend.bookusagerecords', compact('usageRecords'));

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
    public function show(BookAccessData $bookAccessData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookAccessData $bookAccessData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookAccessData $bookAccessData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookAccessData $bookAccessData)
    {
        //
    }
}
