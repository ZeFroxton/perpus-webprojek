<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LoanLog;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $loanLogs = LoanLog::with(['loan.user', 'loan.book'])->get();
        return view('admin.petugas.dashboard_petugas',compact('loanLogs'));
    }

    public function tablePetugas(){
        $petugas = User::where('role', 'petugas')->get();
        return view('admin.petugas.index', compact('petugas'));
    }

    public function showCreatePetugasForm()
    {
        return view('admin.petugas.create');
    }

    // Menyimpan data petugas baru
    public function createPetugas(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas',
        ]);

        return redirect()->route('admin.table')->with('success', 'Petugas baru berhasil dibuat.');
    }
}
