<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event_picture extends Model
{
    use HasFactory;
    protected $table = 'event_pictures'; // Change this to your actual table name
    protected $primaryKey = 'picture_id';
    protected $fillable = [
        'picture_id',
        'event_id',
        'user_id',
        'picture_path',
        'comments',
        'upload_date',
        'like_count',
    ];
}
