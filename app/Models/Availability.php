<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['counsellor_id', 'day_of_week', 'start_time', 'end_time'])]
class Availability extends Model
{
    use HasFactory;

    public function counsellor()
    {
        return $this->belongsTo(User::class, 'counsellor_id');
    }
}
