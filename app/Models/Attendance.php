<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'contact',
        'name',
        'more_info',
        'event_id',
        'amount_of_people'
    ];
}
