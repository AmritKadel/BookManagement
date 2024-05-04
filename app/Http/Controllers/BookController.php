<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookAccessData;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            $books = DB::table('books')
                ->join('book_categories', 'book_categories.id', '=', 'books.book_catagory')
                ->join('book_sub_categories', 'book_sub_categories.id', '=', 'books.book_sub_catagory')
                ->join('book_child_categories', 'book_child_categories.id', '=', 'books.book_child_catagory')
                ->join('authors', 'authors.id', '=', 'books.author_id')
                ->select('books.*', 'book_categories.title', 'book_sub_categories.sub_title', 'book_child_categories.child_title', 'authors.fullname')->where('is_deleted', 0)->get();

            return view('backend.books', compact('books'));
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
            'book_title' => 'required|string',
            
            'book_catagory' => 'required|integer',
            'book_sub_catagory' => 'required|integer',
            'book_child_catagory' => 'required|integer',
            
            

        ]);
        $book = new Book();
        $book->book_title = $request->book_title;
        $book->book_catagory = $request->book_catagory;
        $book->book_sub_catagory = $request->book_sub_catagory;
        $book->book_child_catagory = $request->book_child_catagory;
        $book->description = $request->description;
        $book->anyflip_books_link = $request->anyflip_books_link;
        $book->author_id = $request->author_id;
        $book->published_year = $request->published_year;
        $book->feature_or_not = $request->featured_or_not;
        $book->need_user_verification = $request->need_user_verification;
        $book->is_deleted = 0;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $img_name = hexdec(uniqid()) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move('uploads/books/thumbnails/', $img_name);
            $save_url = '/uploads/books/thumbnails/' . $img_name;
            $book->thumbnail = $save_url;
        }

        $book->save();

        return redirect()->back()->with('message', 'Book created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book, $id)
    {
        $books = DB::table('books')
            ->join('book_categories', 'book_categories.id', '=', 'books.book_catagory')
            ->join('book_sub_categories', 'book_sub_categories.id', '=', 'books.book_sub_catagory')
            ->join('book_child_categories', 'book_child_categories.id', '=', 'books.book_child_catagory')
            ->join('authors', 'authors.id', '=', 'books.author_id')
            ->select('books.*', 'book_categories.title', 'book_sub_categories.sub_title', 'book_child_categories.child_title', 'authors.fullname')
            ->where('is_deleted', 0)
            ->get();
        $editBooks = DB::table('books')
            ->join('book_categories', 'book_categories.id', '=', 'books.book_catagory')
            ->join('book_sub_categories', 'book_sub_categories.id', '=', 'books.book_sub_catagory')
            ->join('book_child_categories', 'book_child_categories.id', '=', 'books.book_child_catagory')
            ->join('authors', 'authors.id', '=', 'books.author_id')
            ->select('books.*', 'book_categories.title', 'book_sub_categories.sub_title', 'book_child_categories.child_title', 'authors.fullname')
            ->where('is_deleted', 0)
            ->where('books.id', $id)
            ->first();

        return view('backend.books', compact('books', 'editBooks'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $book = Book::find($id);
        if (!$book) {
            return redirect()->back()->with('message', 'Book not found');
        }

        $book->book_title = $request->book_title;
        $book->book_catagory = $request->book_catagory;
        $book->book_sub_catagory = $request->book_sub_catagory;
        $book->book_child_catagory = $request->book_child_catagory;
        $book->description = $request->description;
        $book->anyflip_books_link = $request->anyflip_books_link;
        $book->author_id = $request->author_id;
        $book->published_year = $request->published_year;
         $book->feature_or_not = $request->featured_or_not;
        $book->need_user_verification = $request->need_user_verification;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $img_name = hexdec(uniqid()) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move('uploads/books/thumbnails/', $img_name);
            $save_url = '/uploads/books/thumbnails/' . $img_name;
            $book->thumbnail = $save_url;
        }

        $book->save();

        return redirect('/addbooks')->with('message', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book, $id)
    {
        {

            DB::table('books')->where('id', $id)->delete(

            );

            return redirect()->back()->with('message', 'Book has been deleted successfully');
        }
    }
    public function bookdescription($id)
    {
        {
            $books = DB::table('books')
                ->join('book_categories', 'book_categories.id', '=', 'books.book_catagory')
                ->join('book_sub_categories', 'book_sub_categories.id', '=', 'books.book_sub_catagory')
                ->join('book_child_categories', 'book_child_categories.id', '=', 'books.book_child_catagory')

                ->join('authors', 'authors.id', '=', 'books.author_id')
                ->select('books.*', 'book_categories.title', 'book_sub_categories.sub_title', 'book_sub_categories.id as sub_id', 'book_child_categories.child_title', 'authors.fullname')
                ->where('is_deleted', 0)->where('books.id', $id)->get();
            $book = DB::table('books')
                ->join('book_sub_categories', 'book_sub_categories.id', '=', 'books.book_sub_catagory')
                ->select('book_sub_categories.id as sub_id')
                ->where('is_deleted', 0)
                ->where('books.id', $id)
                ->first();

            if ($book) {
                $sub_id = $book->sub_id;

                $relatedBooks = DB::table('books')
                    ->join('book_sub_categories', 'book_sub_categories.id', '=', 'books.book_sub_catagory')
                    ->join('authors', 'authors.id', '=', 'books.author_id')
                    ->select('books.*', 'book_sub_categories.sub_title', 'authors.fullname')
                    ->where('is_deleted', 0)
                    ->where('book_sub_categories.id', $sub_id)
                    ->where('books.id', '!=', $id)
                    ->limit(4)
                    ->get();

                return view('frontend.bookdescription', compact('books', 'relatedBooks'));
            }
            $relatedBooks = DB::table('books')
                ->join('book_sub_categories', 'book_sub_categories.id', '=', 'books.book_sub_catagory')
                ->join('authors', 'authors.id', '=', 'books.author_id')
                ->select('books.*', 'book_sub_categories.sub_title', 'authors.fullname')
                ->where('is_deleted', 0)
                ->where('book_sub_categories.id', $sub_id) // Replace $sub_id with the desired sub_id value
                ->where('books.id', '!=', $id) // Exclude the current book by its ID
                ->get();

            return view('frontend.bookdescription', compact('books'));
        }
    }

    public function sendOTP(Request $request)
    {
        if ($request->session()->has('sessionUserId')) {
            $userId = $request->session()->get('sessionUserId');
            $user = \DB::table('public_users')
                ->select('*')
                ->where('id', $userId)
                ->where('email_verified', 1)
                ->where('status', 1)
                ->first();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'You need to be verified by the admin.',
                ]);
            }
            if ($user) {
                $email = $user->email;
                $otp = mt_rand(1000, 9999);

                $request->session()->put('otp', $otp);

                $accessRecords = new BookAccessData();
                $accessRecords->book_id = $request->bookId;
                $accessRecords->user_id = $userId;
                $accessRecords->otp_code = $otp;
                $accessRecords->save();
                $data = [
                    'otp' => $otp,
                ];
                Mail::send('frontend.emailtemplate.otp', $data, function ($message) use ($email) {
                    $message->to($email);
                    $message->from(env('MAIL_USERNAME'));
                    $message->subject('OTP Code for the Book');
                });
                return response()->json([
                    'success' => true,
                    'message' => 'OTP sent successfully.',
                    'redirect' => url('/bookdescription/' . $request->bookId),
                ]);
            }
        }

        $request->session()->put('redirectUrl', '/bookdescription/' . $request->bookId);

        return response()->json([
            'success' => false,
            'message' => 'Please login first to read the book',
            'redirect' => url('/login'),
        ]);
    }

    public function verifyOTP(Request $request)
    {
        $anyFlipLink = $request->input('anyFlipLink');
        $otpInput1 = $request->input('otpInput1');
        $otpInput2 = $request->input('otpInput2');
        $otpInput3 = $request->input('otpInput3');
        $otpInput4 = $request->input('otpInput4');

        $sessionOtp = $request->session()->get('otp');
        $otpInputs = $otpInput1 . $otpInput2 . $otpInput3 . $otpInput4;

        if ($otpInputs == $sessionOtp) {
            $request->session()->forget('otp');
            return response()->json([
                'success' => true,
                'message' => 'OTP verification successful.',
                'link' => $anyFlipLink,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'OTP verification failed. Please try again.',
            ]);
        }
    }

}
