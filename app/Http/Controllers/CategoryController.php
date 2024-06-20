<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function indexAdmin()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function indexPetugas()
    {
        $categories = Category::all();
        return view('admin.petugas.category.index', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function storeAdmin(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|min:5',
        ]);

        //upload image

        //create post
        $category = new Category();
        $category->name = $request->name;

        $category->save();

        // Redirect ke halaman indeks kategori dengan pesan sukses
        return redirect()->route('category.admin')
                         ->with('success', 'Kategori created successfully.');

    }
    public function storePetugas(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|min:5',
        ]);

        //upload image

        //create post
        $category = new Category();
        $category->name = $request->name;

        $category->save();

        // Redirect ke halaman indeks kategori dengan pesan sukses
        return redirect()->route('category.index')
                         ->with('success', 'Kategori created successfully.');

    }

    // Metode untuk mengupdate kategori
    public function updateAdmin(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $kategori = Category::findOrFail($id);
        $kategori->update([
            'name' => $request->name
        ]);

        return redirect()->route('category.admin')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function updatePetugas(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $kategori = Category::findOrFail($id);
        $kategori->update([
            'name' => $request->name
        ]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Metode untuk menghapus kategori
    public function destroyAdmin($id)
    {
        $kategori = Category::findOrFail($id);
        $kategori->delete();

        return redirect()->route('category.admin')->with('success', 'Kategori berhasil dihapus.');
    }

    public function destroyPetugas($id)
    {
        $kategori = Category::findOrFail($id);
        $kategori->delete();

        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus.');
    }

}
