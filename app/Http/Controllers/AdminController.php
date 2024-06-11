<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        // Mengurutkan atau mengacak buku berdasarkan request
        if ($request->has('order') && $request->order == 'random') {
            $query->inRandomOrder();
        } else {
            $query->orderBy('id', 'asc');
        }

        // Batasi jumlah buku yang ditampilkan
        $books = $query->paginate(10);
        $books = Book::with('kategori')->get();

        return view('admin.dashboard_admin', compact('books'));
    }

}
