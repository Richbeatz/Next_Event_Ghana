<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
    {
    use HasFactory;
    protected $primaryKey = 'event_id';
    protected $fillable = [
        'Events_id', 'event_id', 'user_id', 'organizer_name', 
        'event_name', 'event_venue', 'event_description', 
        'gps_location', 'event_date', 'event_time', 
        'contact_info', 'flyer_path', 'celebs_list', 'ussd_code'

    ];

    }
