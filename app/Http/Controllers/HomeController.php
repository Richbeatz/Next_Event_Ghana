<?php

namespace App\Http\Controllers;

use App\Models\LoanGuarantor;
use App\Models\LoanCustomer;
use App\Models\ticketRequest;
use App\Models\event;
use App\Models\Reciept;
use App\Models\LoanApproval;   
use App\Models\User;
use App\Models\advert;
use App\Models\visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Toastr;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    
public function index(Request $id)
{
    // $Events = events::where('user_id',Auth::user()->id)->get();
    $featured_Events = event::where('status','featured')
                            -> where('approval_flag','Y')
                            ->get();
    $popularEvents = event::select('events.*', DB::raw('AVG(event_ratings.rating) AS avg_rating'))
                ->leftJoin('event_ratings', 'events.event_id', '=', 'event_ratings.event_id')
                ->where('events.approval_flag', 'Y')
                ->groupBy('events.event_id','Events_id','user_id','organizer_name','event_name','event_name' ,'event_venue','event_description','gps_location','event_date','event_time',
                'contact_info','flyer_path','celebs_list','status','likes','dislikes','approval_flag','created_at','updated_at','ussd_code','purchase_count' ) // Add all necessary columns
                ->orderBy('avg_rating', 'DESC')
                ->get();

    $events = event::all();
    $advert = advert::where('status','R')->get();
        //dd($featured_Events);
    $visits = visitor::where('id', 1)->value('visits');
     // dd( $events);
    return view('home',['featured_Events'=>$featured_Events, 'popularEvents' => $popularEvents,'visits'=>$visits,'events'=>$events,'advert' => $advert]);
    
}

public function admin() {
    // Retrieve events with approval_flag 'N'
    $admin = event::where('approval_flag', 'N')->get();
    $ads = advert::orderBy('created_at', 'desc')->get();
    $feature = event::all();
    // Return the view with the retrieved events
    return view('workspace.events.admin', compact('admin','ads','feature'));
}
    
public function get_feature() {
    $feature = event::all();
    // Return the view with the retrieved events
    return view('workspace.events.feature', compact('feature'));
}


public function top_search(Request $request) {
    $search = $request->get('search');
    
    // Fetch events that match the search query
    $events = event::where('event_name', 'LIKE', "%{$search}%")
                   ->orWhere('event_venue', 'LIKE', "%{$search}%")
                   ->get();

    // Return a view or a partial view with the search results
    return view('inc.search-results', compact('events'));
}

}
