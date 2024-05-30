<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
class BookController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('admin.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('admin.book.create', );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul'     => 'required|min:5',
            'author'    => 'required|min:5',
            'publisher'    => 'required|min:5',
            'detailbuku'    => 'required|min:5',
            'halaman'   => 'required|integer',
            'tahunterbit'   => 'required|integer',
            'cover_image'  => 'required|image|mimes:jpeg,jpg,png',
            'stock'   => 'required|integer',

        ]);

        //upload image
        $cover_image = $request->file('cover_image');
        $cover_image = $cover_image->storeAs('public/posts', $cover_image->hashName());

        //create post
        $buku = new Book();
        $buku->judul = $request->judul;
        $buku->author = $request->author;
        $buku->publisher = $request->publisher;
        $buku->detailbuku = $request->detailbuku;
        $buku->halaman = $request->halaman;
        $buku->tahunterbit = $request->tahunterbit;
        $buku->cover_image = $request->cover_image->hashName();
        $buku->stock = $request->stock;



        if ($buku->save()) {
            return redirect(route('buku.index'))->with('success', 'Book added successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to add book');
        }


    }

    /**
     * Display the specified resource.
     */
//     public function show(string $id)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(string $id)
//     {
//         $books = Book::find($id);
//         return view('buku.edit', compact('book'));
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
//     {
//         $this->validate($request, [
//             'judul'     => 'required|min:5',
//             'author'    => 'required|min:5',
//             'publisher'    => 'required|min:5',
//             'detailbuku'    => 'required|min:5',
//             'halaman'   => 'required|integer',
//             'tahunterbit'   => 'required|integer',
//             'cover_image'     => 'required|image|mimes:jpeg,jpg,png',
//             'stock'   => 'required|integer',
//             'kategori_id' => 'required'


//         ]);

//         $buku = Book::find($id);
//         $buku->judul = $request->judul;
//         $buku->author = $request->author;
//         $buku->publisher = $request->publisher;
//         $buku->detailbuku = $request->detailbuku;
//         $buku->halaman = $request->halaman;
//         $buku->tahunterbit = $request->tahunterbit;
//         $buku->cover_image = $request->cover_image->hashName();
//         $buku->stock = $request->stock;
//         $buku->kategori_id = $request->kategori_id;

//         $cover_image = $request->file('cover_image');
//         $cover_image->storeAs('public/posts', $cover_image->hashName());

//         //delete old image
//         // Storage::delete('public/posts/'.$post->image);

//         if ($buku->save()) {
//             return redirect(route('buku.index'));
//         }else {
//             return "Gagal";
//         }

//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         Book::destroy($id);

//         return redirect(route('buku.index'));
//     }
 }
