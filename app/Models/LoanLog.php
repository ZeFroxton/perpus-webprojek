<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id', 'user_id', 'book_id', 'action', 'fine_amount', 'action_date'
    ];

    protected $casts = [
        'action_date' => 'datetime',
    ];
    
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
