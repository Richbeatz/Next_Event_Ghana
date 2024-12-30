<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reciept extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'event_id',
        'title',
        'first_name',
        'other_names',
        'event_name',
        'event_type',
        'year',
        'even_details',
        'picture',
        'doner',
        'amount',
        'amount_in_words',
        'contact',
        'given_to',
        'mode_of_payment',
         'User_id'
       
    ];
}
