<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Loan;
use App\Models\LoanLog;
use App\Models\Favorite;
use Illuminate\View\View;

class UserController extends Controller
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
        return view('user.dashboard_user', compact('books'));
    }

    public function show(string $id)
    {
        $post = Book::with('reviews.user')->findOrFail($id);
        $loanPending = Loan::where('book_id', $id)
            ->where('user_id', Auth::id())
            ->where('is_approved', false)
            ->exists();

        $loanApproved = Loan::where('book_id', $id)
        ->where('user_id', Auth::id())
        ->where('is_approved', true)
        ->where('is_returned', false)
        ->first();

        $loanReturned = Loan::where('book_id', $id)
        ->where('user_id', Auth::id())
        ->where('is_returned', true)
        ->doesntHave('reviews')
        ->first();

        $isFavorite = Favorite::where('user_id', Auth::id())
        ->where('book_id', $id)
        ->exists();
        //render view with post
        return view('user.show', compact('post' , 'loanPending' ,'loanApproved', 'loanReturned', 'isFavorite'));
    }

    public function editUser(Request $request): View
    {
        return view('user.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function updateUser(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroyUser(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function loanindex()
    {
        $loans = Loan::where('user_id', Auth::id())->where('is_returned', false)->get();
        return view('user.daftarloan', compact('loans'));
    }

    public function returnBook($loanId)
{
    $loan = Loan::findOrFail($loanId);
    if ($loan->user_id !== Auth::id()) {
        return redirect()->route('user.loans')->with('error', 'Unauthorized action.');
    }

    $loan->is_returned = true;
    $loan->actual_return_date = now();

    $fine = 0;
    if ($loan->return_date < now()) {
        $daysOverdue = now()->diffInDays($loan->return_date);
        $fine = $daysOverdue * 1000; // Misalnya denda 1000 per hari
        $loan->fine = $fine;
    }

    $loan->save();

    // Log return action
    LoanLog::create([
        'loan_id' => $loan->id,
        'user_id' => Auth::id(),
        'book_id' => $loan->book_id,
        'action' => 'returned',
        'action_date' => now(),
        'fine_amount' => $fine
    ]);

    // Update book stock after return
    $book = $loan->book;
    $book->stock += 1;
    $book->save();

    return redirect()->route('show.buku', ['id' => $loan->book_id])->with('success', 'Book returned successfully.');
}

}
