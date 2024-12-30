<?php

namespace App\Models;
use App\Models\MemoApproval;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticketRequest extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'ticket_id',
        'ref_num',
        'title',
        'first_name',
        'other_names',
        'year',
        'event_name',
        'event_type',
        'even_details',
        'picture'
       
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function MemoApproval()
    {
        return $this->hasMany(MemoApproval::class);
    }

}
