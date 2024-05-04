<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use App\Models\BookChildCategory;
use App\Models\BookSubCategory;
use DB;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function getServices()
    {
        $service = DB::table('services')->select('*')->get();
        return view('frontend.service', compact('service'));

    }
    public function getBooksData(Request $request)
    {
        $categories = BookCategory::all();
        $subCategories = BookSubCategory::all();
        $childCategories = BookChildCategory::all();
        $query = DB::table('books')
            ->join('book_categories', 'book_categories.id', '=', 'books.book_catagory')
            ->join('book_sub_categories', 'book_sub_categories.id', '=', 'books.book_sub_catagory')
            ->join('book_child_categories', 'book_child_categories.id', '=', 'books.book_child_catagory')
            ->join('authors', 'authors.id', '=', 'books.author_id')
            ->select('books.*', 'book_categories.title', 'book_sub_categories.sub_title', 'book_child_categories.child_title', 'authors.fullname')
            ->where('is_deleted', 0);
        $books = $query->get();

        return view('frontend.books', compact('categories', 'subCategories', 'childCategories', 'books'));
    }
    public function getSearchResults(Request $request)
    {
        $type = $request->input('type');
        $subject = $request->input('subject');
        $class = $request->input('class');
        $search = $request->input('search');

        $query = DB::table('books')
            ->join('book_categories', 'book_categories.id', '=', 'books.book_catagory')
            ->join('book_sub_categories', 'book_sub_categories.id', '=', 'books.book_sub_catagory')
            ->join('book_child_categories', 'book_child_categories.id', '=', 'books.book_child_catagory')
            ->join('authors', 'authors.id', '=', 'books.author_id')
            ->select('books.*', 'book_categories.title', 'book_sub_categories.sub_title', 'book_child_categories.child_title', 'authors.fullname')
            ->where('is_deleted', 0);

        if ($type && $type !== 'All') {
            $query->where('book_categories.title', $type);
        }
        if ($subject && $subject !== 'Select Subject') {
            $query->where('book_sub_categories.id', $subject);
        }
        if ($class && $class !== 'Select Class') {
            $query->where('book_child_categories.id', $class);
        }
        if ($search) {
            $query->where('books.book_title', 'LIKE', '%' . $search . '%');
        }

        $books = $query->get();

        return response()->json($books);
    }
    

    public function getHomePage()
    {
        $sliderimages = DB::table('slider_images')->select('*')->get();
        $author = DB::table('authors')
            ->select('*')
            ->limit(4)
            ->where('status', 0)
            ->get();

         
        $aboutus = DB::table('about_us')->select('*')->get();
        $recentbooks = DB::table('books')->select('*')->orderby('id', 'DESC')->limit(4)->get();
        $modelquestions = DB::table('books')->select('*')->orderby('id', 'DESC')->where('book_catagory',3)->get();
        $reviews = DB::table('testimonials')->select('*')->orderby('id', 'DESC')->get();
        $popupimage = DB::table('popup_image')->select('*')->where('enable',1)->get();
        $query = DB::table('books')
            ->join('book_categories', 'book_categories.id', '=', 'books.book_catagory')
            ->join('book_sub_categories', 'book_sub_categories.id', '=', 'books.book_sub_catagory')
            ->join('book_child_categories', 'book_child_categories.id', '=', 'books.book_child_catagory')
            ->join('authors', 'authors.id', '=', 'books.author_id')
            ->select('books.*', 'book_categories.title', 'book_sub_categories.sub_title', 'book_child_categories.child_title', 'authors.fullname')
            ->where('is_deleted', 0)
            ->where('feature_or_not', 1);
        $featurebook = $query->limit(6)->get();
        
        return view('frontend.main', compact('author', 'featurebook', 'sliderimages', 'aboutus', 'recentbooks','modelquestions','reviews','popupimage'));
    }
    public function forRegisteration()
    {
        $userDistrict = DB::table('user_districts')
                ->select('*')
                ->orderBy('title', 'asc') 
                ->get();
        $userRoles = DB::table('user_roles')->select('*')->get();
        return view('frontend.register', compact('userRoles', 'userDistrict'));
    }
    public function foraboutus()
    {
        $aboutus = DB::table('about_us')->select('*')->get();
        $achivements = DB::table('achivements')->select('*')->get();
        $teams = DB::table('teams')->select('*')->get();
        return view('frontend.about', compact('aboutus', 'achivements','teams'));
    }

}
