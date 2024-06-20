<?php

namespace App\Http\Controllers;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function addToFavorites($bookId)
    {
        $favorite = Favorite::create([
            'user_id' => Auth::id(),
            'book_id' => $bookId
        ]);

        return back()->with('success', 'Book added to favorites');
    }

    public function removeFromFavorites($bookId)
    {
        $favorite = Favorite::where('user_id', Auth::id())
            ->where('book_id', $bookId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Book removed from favorites');
        }

        return back()->with('error', 'Book not found in favorites');
    }
}
