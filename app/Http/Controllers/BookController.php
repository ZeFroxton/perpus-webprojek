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
    public function indexAdmin()
    {
        $books = Book::with('kategori')->get();
        return view('admin.book.index', compact('books'));
    }

    public function indexPetugas()
    {
        $books = Book::with('kategori')->get();
        return view('admin.petugas.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createAdmin()
    {
        $kategori = Category::all();
        return view('admin.book.create', compact('kategori'));
    }

    public function createPetugas()
    {
        $kategori = Category::all();
        return view('admin.petugas.book.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeAdmin(Request $request)
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
            'kategori_id' => 'required|exists:categories,id'

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
        $buku->kategori_id = $request->kategori_id;



        if ($buku->save()) {
            return redirect(route('buku.admin'))->with('success', 'Book added successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to add book');
        }


    }

    public function storePetugas(Request $request)
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
            'kategori_id' => 'required|exists:categories,id'

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
        $buku->kategori_id = $request->kategori_id;



        if ($buku->save()) {
            return redirect(route('buku.index'))->with('success', 'Book added successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to add book');
        }


    }

    /**
     * Display the specified resource.
     */


//     /**
//      * Show the form for editing the specified resource.
//      */
    public function editAdmin(string $id)
    {
        $book = Book::find($id);
        $kategori = Category::all();
        return view('admin.book.edit', compact('book','kategori'));
    }

    public function editPetugas(string $id)
    {
        $book = Book::find($id);
        return view('admin.petugas.book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAdmin(Request $request, string $id)
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
            'kategori_id' => 'required|exists:categories,id'


        ]);

        $buku = Book::find($id);

        if ($request->hasFile('cover_image')) {

            //upload new image
            $cover_image = $request->file('cover_image');
            $cover_image->storeAs('public/posts', $cover_image->hashName());

            //delete old image
            Storage::delete('public/posts/'.$buku->cover_image);

            //update post with new image
            $buku->update([
                'judul'     => $request->judul,
                'author'    => $request->author,
                'publisher'    => $request->publisher,
                'detailbuku'    => $request->detailbuku,
                'halaman'   => $request->halaman,
                'tahunterbit'   => $request->tahunterbit,
                'cover_image'  =>  $request->cover_image->hashName(),
                'stock'   => $request->stock,
                'kategori_id' => $request->kategori_id
            ]);

        } else {

            //update post without image
            $buku->update([
                'judul'     => $request->judul,
                'author'    => $request->author,
                'publisher'    => $request->publisher,
                'detailbuku'    => $request->detailbuku,
                'halaman'   => $request->halaman,
                'tahunterbit'   => $request->tahunterbit,
                'stock'   => $request->stock,
                'kategori_id' => $request->kategori_id
            ]);
        }


        if ($buku->save()) {
            return redirect()->route('buku.admin')->with(['success' => 'Data Berhasil Diubah!']);
        }else {
            return "Gagal";
        }

    }

    public function updatePetugas(Request $request, string $id)
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
            'kategori_id' => 'required|exists:categories,id'


        ]);

        $buku = Book::find($id);

        if ($request->hasFile('cover_image')) {

            //upload new image
            $cover_image = $request->file('cover_image');
            $cover_image->storeAs('public/posts', $cover_image->hashName());

            //delete old image
            Storage::delete('public/posts/'.$buku->cover_image);

            //update post with new image
            $buku->update([
                'judul'     => $request->judul,
                'author'    => $request->author,
                'publisher'    => $request->publisher,
                'detailbuku'    => $request->detailbuku,
                'halaman'   => $request->halaman,
                'tahunterbit'   => $request->tahunterbit,
                'cover_image'  =>  $request->cover_image->hashName(),
                'stock'   => $request->stock,
                'kategori_id' => $request->kategori_id
            ]);

        } else {

            //update post without image
            $buku->update([
                'judul'     => $request->judul,
                'author'    => $request->author,
                'publisher'    => $request->publisher,
                'detailbuku'    => $request->detailbuku,
                'halaman'   => $request->halaman,
                'tahunterbit'   => $request->tahunterbit,
                'stock'   => $request->stock,
                'kategori_id' => $request->kategori_id
            ]);
        }


        if ($buku->save()) {
            return redirect()->route('buku.index')->with(['success' => 'Data Berhasil Diubah!']);
        }else {
            return "Gagal";
        }

    }

//     /**
//      * Remove the specified resource from storage.
//      */
    public function destroyAdmin($id): RedirectResponse
    {
        //get post by ID
        $buku = Book::findOrFail($id);

        //delete image
        Storage::delete('public/posts/'. $buku->image);

        //delete post
        $buku->delete();

        //redirect to index
        return redirect()->route('buku.admin')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function destroypetugas($id): RedirectResponse
    {
        //get post by ID
        $buku = Book::findOrFail($id);

        //delete image
        Storage::delete('public/posts/'. $buku->image);

        //delete post
        $buku->delete();

        //redirect to index
        return redirect()->route('book.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
 }
