<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\LoanLog;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{

    public function requestLoan(Request $request)
{
    $request->validate([
        'book_id' => 'required|exists:books,id',
        'return_date' => 'required|date|after:today',
    ]);

    $book = Book::find($request->book_id);

    if ($book->stock < 1) {
        return back()->withErrors(['Book is out of stock']);
    }

    $loan = new Loan([
        'user_id' => Auth::id(),
        'book_id' => $request->book_id,
        'borrow_date' => now(),
        'return_date' => $request->return_date,
        'is_approved' => false,
    ]);
    $loan->save();

    LoanLog::create([
        'loan_id' => $loan->id,
        'user_id' => Auth::id(),
        'book_id' => $loan->book_id,
        'action' => 'requested',
        'action_date' => now()
    ]);


    return redirect()->route('show.buku', ['id' => $request->book_id])
    ->with('success', 'Loan request submitted. Waiting for approval.')
    ->with('swal', true);
}

    public function approveLoan($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->is_approved = true;
        $loan->save();

        $book = $loan->book;
        $book->stock -= 1;
        $book->save();

        return response()->json(['message' => 'Loan approved'], 200);
    }

    public function returnBook($loanId)
    {
        $loan = Loan::findOrFail($loanId);
        if ($loan->user_id !== Auth::id()) {
            return redirect()->route('profile')->with('error', 'Unauthorized action.');
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

        $book = $loan->book;
        $book->stock += 1;
        $book->save();

        return redirect()->route('profile')->with('success', 'Book returned successfully.');
    }


    public function checkOverdue()
    {
        $loans = Loan::where('return_date', '<', now())->where('is_approved', true)->where('is_returned', false)->get();

        foreach ($loans as $loan) {
            $daysOverdue = now()->diffInDays($loan->return_date);
            $fine = $daysOverdue * 1000; // Misalnya denda 1000 per hari
            $loan->fine = $fine;
            $loan->save();

            LoanLog::create([
                'loan_id' => $loan->id,
                'user_id' => $loan->user_id,
                'book_id' => $loan->book_id,
                'action' => 'fine',
                'fine_amount' => $fine,
                'action_date' => now()
            ]);
        }

        return response()->json($loans, 200);
    }
    public function submitReview(Request $request, $loanId)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'required|string',
    ]);

    $loan = Loan::findOrFail($loanId);

    if ($loan->user_id !== Auth::id()) {
        return redirect()->route('user.loans')->with('error', 'Unauthorized action.');
    }

    Review::create([
        'user_id' => Auth::id(),
        'book_id' => $loan->book_id,
        'loan_id' => $loanId,
        'rating' => $request->rating,
        'review' => $request->review,
    ]);

    return redirect()->route('show.buku', ['id' => $loan->book_id])
        ->with('success', 'Thank you for your review.');
}

}


