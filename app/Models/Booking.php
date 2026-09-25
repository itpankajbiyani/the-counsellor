<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'counsellor_id', 'date', 'start_time', 'end_time', 'status', 'cancellation_reason', 'message'])]
class Booking extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function counsellor()
    {
        return $this->belongsTo(User::class, 'counsellor_id');
    }
}
