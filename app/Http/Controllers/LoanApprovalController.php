<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;

class LoanApprovalController extends Controller
{
    public function index()
    {
        $loanRequests = Loan::where('is_approved', false)->get();

        return view('admin.petugas.Aproval', compact('loanRequests'));
    }

    public function approve($loanId)
    {
        $loan = Loan::findOrFail($loanId);
        $loan->is_approved = true;
        $loan->save();

        return redirect()->route('admin.loan.requests')->with('success', 'Loan approved successfully.');
    }

    public function reject($loanId)
    {
        $loan = Loan::findOrFail($loanId);
        $loan->delete();

        return redirect()->route('admin.loan.requests')->with('success', 'Loan rejected and deleted successfully.');
    }
}
