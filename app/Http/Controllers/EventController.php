<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Reciept; 
use App\Models\event;
use App\Models\event_rating;  
use App\Models\event_picture; 
use App\Models\like; 
use App\Models\comment;   
use App\Models\advert;   
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;   
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use PDF;
use ZipArchive;
use Fpdf;
use DateTime;


class EventController extends Controller
{

    public function show($event_id, $Events_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }
        // Fetch the event
        $event = event::where('event_id', $event_id)->where('Events_id', $Events_id)->first();
    
      

        // Check if the event exists
        if (!$event) {
            return redirect()->back()->with('error', 'Event not found.');
        }
    
        // Fetch the average rating
        $averageRating = event_rating::where('event_id', $event_id)->avg('rating');
    
        // Fetch pictures for the specified event
        $eventPictures = event_picture::where('event_id', $event_id)->get();
    
        $picturesWithComments = [];
    
        foreach ($eventPictures as $picture) {
            // Count comments for each picture
            $commentCount = comment::where('picture_id', $picture->picture_id)->count();
    
            // Fetch comments for each picture
            $comments = comment::where('picture_id', $picture->picture_id)->orderBy('timestamp', 'desc')->get();
    
            // Prepare arrays to hold comment texts, timestamps, user IDs, and usernames
            $commentTexts = [];
            $timestamps = [];
            $userIds = [];
            $usernames = []; // Array to hold usernames
    
            // Loop through the comments to extract the text, timestamp, and user ID
            foreach ($comments as $comment) {
                $commentTexts[] = $comment->comment_text; // Assuming 'comment_text' is the column name for comment text
                $timestamps[] = $comment->timestamp; // Assuming 'timestamp' is the column name for the timestamp
                $userIds[] = $comment->user_id; // Store the user ID
                
            }
    
            // Fetch usernames based on user IDs
            if (!empty($userIds)) {
                $usernames = User::whereIn('id', $userIds)->pluck('username', 'id')->toArray(); // Assuming 'username' is the column name for usernames
            }
    
            $picturesWithComments[$picture->picture_id] = [
                'picture_id' => $picture->picture_id,
                'picture_path' => $picture->picture_path,
                'comment_count' => $commentCount, // Store the comment count
                'comment_texts' => $commentTexts, // Store the array of comment texts
                'timestamps' => $timestamps, // Store the array of timestamps
                'user_ids' => $userIds, // Store the array of user IDs
                'usernames' => $usernames, // Store the array of usernames
                
            ];
        }
   // dd($picturesWithComments);
        return view('event_details', compact('event', 'averageRating', 'eventPictures', 'picturesWithComments'));
    }


    public function checkRating($eventId, $userId)
{
    $hasRated = event_rating::where('event_id', $eventId)->where('user_id', $userId)->exists();
    return response()->json(['hasRated' => $hasRated]);
}

public function rateEvent(Request $request, $eventId)
{



    $rating = new event_rating();
    $rating->event_id = $request->eventId;
    $rating->user_id = Auth::user()->id; // Assuming the user is authenticated
    $rating->rating = $request->rating;
    $rating->save();

    // Calculate the new average rating
    $averageRating = event_rating::where('event_id', $eventId)->avg('rating');
    Toastr::success('Creation successful', 'Event Creation');
    // Return a success response with the new average rating
    return response()->json(['success' => true, 'averageRating' => $averageRating]);
}


        public function upload(Request $request)
        {
            $request->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'event_id' => 'required|exists:events,event_id',
            ]);

            $picture_path = $request->file('picture'); // Get the uploaded file
            $filename = time() . '_' . $picture_path->getClientOriginalName(); // Create a unique filename
            $path = $picture_path->storeAs('posts', $filename); 
        
            // Create a new event
            $upload = new event_picture(); // Ensure the model name is capitalized
            $upload->user_id = Auth::user()->id;
            $upload->event_id = $request->event_id;
            $upload->picture_path =  $filename;
            $upload->like_count = $request->like_count;
            $upload->upload_date = $request->upload_date;
            $upload->save();
        
            Toastr::success('Upload successful', 'Picture Upload');
            return redirect()->back()->with('success', 'Picture uploaded successfully!');
        }

// liking a picture
public function like(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'picture_id' => 'required|exists:event_pictures,picture_id',
        'user_id' => 'required|exists:users,id',
    ]);

    // Check if the like already exists
    $existingLike = Like::where('user_id', Auth::user()->id)
                        ->where('picture_id', $request->picture_id)
                        ->first();

    if ($existingLike) {
        return response()->json(['success' => false, 'message' => 'You have already liked this picture.'], 409);
    }

    // Create a new like
    $like = new Like();
    $like->user_id = Auth::user()->id;
    $like->picture_id = $request->picture_id;
    $like->save();

    // Update the like_count in the event_pictures table
    $likecount = event_Picture::find($request->picture_id);

    if ($likecount) {
        $likecount->like_count += 1;
        $likecount->save();
    } else {
        return response()->json(['success' => false, 'message' => 'Picture not found.'], 404);
    }

    return response()->json(['success' => true]);
}

//submitting comment
public function store(Request $request)
{
    $request->validate([
        'picture_id' => 'required|exists:event_pictures,picture_id',
        'comment_text' => 'required|string|max:255',
    ]);

    $comment = new Comment();
    $comment->picture_id = $request->picture_id;
    $comment->comment_text = $request->comment_text;
    $comment->user_id = Auth::user()->id; // Assuming the user is authenticated
    $comment->save();

     // Fetch updated comments and count
    $comments = Comment::where('picture_id', $request->picture_id)->orderBy('timestamp', 'desc')->get();
    $commentCount = $comments->count();

    // Prepare arrays to hold comment texts, timestamps, user IDs, and usernames
    $commentTexts = [];
    $timestamps = [];
    $userIds = [];
    $usernames = [];

    foreach ($comments as $comment) {
        $commentTexts[] = $comment->comment_text;
        $timestamps[] = $comment->timestamp;
        $userIds[] = $comment->user_id;
    }

    // Fetch usernames based on user IDs
    if (!empty($userIds)) {
        $usernames = User::whereIn('id', $userIds)->pluck('username', 'id')->toArray();
    }

    return response()->json([
        'success' => true,
        'comment_count' => $commentCount,
        'comments' => array_map(function($text, $timestamp, $userId) use ($usernames) {
            return [
                'text' => $text,
                'timestamp' => $timestamp,
                'username' => $usernames[$userId] ?? 'Unknown User',
            ];
        }, $commentTexts, $timestamps, $userIds),
    ]);

}

//saving event

public function create()
{
    $userId = Auth::user()->id; // Get the logged-in user's ID
   // $profilePicturePath = 'images/profile_pictures/default-profile.png'; // Default profile picture

    // Retrieve user's profile picture from the database
    if ($userId) {
        $user = \DB::table('users')->where('id', $userId)->first();
        if ($user) {
            $profilePicturePath = $user->profile_picture;
        }
    }

    return view('workspace.events.create_event', compact('profilePicturePath'));
}

public function storeevent(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login'); // Redirect to login if not authenticated
    }

    $flyer_path = $request->file('attach_flyer'); // Get the uploaded file
    $filename = time() . '_' . $flyer_path->getClientOriginalName(); // Create a unique filename
    $path = $flyer_path->storeAs('flyers', $filename); 

    // Create a new event
    $newevent = new event(); // Ensure the model name is capitalized
    $newevent->Events_id = Str::random(18);
    $newevent->user_id = Auth::user()->id;
    $newevent->organizer_name = $request->organizer_name;
    $newevent->event_name = $request->event_name;
    $newevent->event_venue = $request->event_venue;
    $newevent->event_description = $request->event_description;
    $newevent->gps_location = $request->gps_location;
    $newevent->event_date = $request->event_date;
    $newevent->event_time = $request->event_time;
    $newevent->contact_info = $request->contact_info;
    $newevent->flyer_path = $filename; // Store the filename
    $newevent->celebs_list = $request->celebs_list;  
    $newevent->ussd_code = $request->ussd_code; 
    $newevent->status = 'normal';
    $newevent->approval_flag = 'N';


    $newevent->save();

    Toastr::success('Creation successful', 'Event Creation');
    return redirect()->back()->with('success', 'Event added successfully!');
}


public function index()
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $userId = Auth::user()->id;
        $user = DB::table('users')->where('id', $userId)->first();
        $profilePicturePath = $user->profile_picture ?? 'default-profile.jpg';

        // Query to select events from the database
        $events = DB::table('events')
            ->where('event_date', '>=', now())
            ->where('approval_flag', 'Y')
            ->orderBy('event_date', 'asc')
            ->orderBy('event_time', 'asc')
            ->get();

        return view('workspace.events.upcoming_events', compact('events', 'profilePicturePath'));
    }


    public function posts()
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        $userId = Auth::user()->id;
        $user = DB::table('users')->where('id', $userId)->first();
        $profilePicturePath = $user->profile_picture ?? 'default-profile.jpg';

        // Query to select events from the database
        $events = DB::table('events')
            ->where('user_id', Auth::user()->id)
            ->where('approval_flag', 'Y')
            ->orderBy('event_date', 'asc')
            ->orderBy('event_time', 'asc')
            ->get();

        return view('workspace.events.posts', compact('events', 'profilePicturePath'));
    }

    public function editevent($event_id = 0)
    {
        // Retrieve the event by its ID
        $events = Event::where('event_id', $event_id)->first(); // Use first() to get the first matching record
    
        // Check if the event exists
        if (!$events) {
            // Redirect back with an error message if the event is not found
            return redirect()->route('events.index')->with('error', 'Event not found.');
        }
    
        // Pass the event data to the view
        return view('workspace.events.edit', compact('events'));
    }




//updating event
public function updateevent(Request $request, $event_id)
{
    if (!Auth::check()) {
        return redirect()->route('login'); // Redirect to login if not authenticated
    }

    // Find the existing event by event_id
    $event = Event::where('event_id', $request->event_id)->first();

    // If the event does not exist, return an error
    if (!$event) {
        return redirect()->back()->with('error', 'Event not found.');
    }

    // Check if a flyer is uploaded
    if ($request->hasFile('attach_flyer')) {
        $flyer_path = $request->file('attach_flyer'); // Get the uploaded file
        $filename = time() . '_' . $flyer_path->getClientOriginalName(); // Create a unique filename
        $path = $flyer_path->storeAs('flyers', $filename); 
        $event->flyer_path = $filename; // Store the filename
    }

    // Update the event details
    $event->organizer_name = $request->organizer_name;
    $event->event_name = $request->event_name;
    $event->event_venue = $request->event_venue;
    $event->event_description = $request->event_description;
    $event->gps_location = $request->gps_location;
    $event->event_date = $request->event_date;
    $event->event_time = $request->event_time;
    $event->contact_info = $request->contact_info;
    $event->celebs_list = $request->celebs_list;

    // Save the updated event
    $event->save(); 

    // Flash success message
    Toastr::success('Update successful', 'Event Update');
    return redirect()->back()->with('success', 'Event updated successfully!');
}

public function deleteEvent($event_id)
{
    if (!Auth::check()) {
        return redirect()->route('login'); // Redirect to login if not authenticated
    }

    // Find the event by event_id
    $event = Event::where('event_id', $event_id)->first();

    // If the event does not exist, return an error
    if (!$event) {
        return redirect()->back()->with('error', 'Event not found.');
    }

    // Check for related records in the event_pictures table
    $relatedPictures = event_picture::where('event_id', $event_id)->count();

    if ($relatedPictures > 0) {
        // Option 1: Return an error message
       // return redirect()->back()->with('error', 'Cannot delete event because it has associated pictures.');

        // Option 2: Delete related pictures before deleting the event (uncomment if you want this behavior)
        event_picture::where('event_id', $event_id)->delete();
    }

    // Delete the event
    $event->delete();

    // Flash success message
    Toastr::success('Event deleted successfully', 'Event Delete');
    return redirect()->route('posts'); // Redirect to the events index or another appropriate route
}


public function confirmDelete($event_id)
{
    if (!Auth::check()) {
        return redirect()->route('login'); // Redirect to login if not authenticated
    }

    // Find the event by event_id
    $event = Event::where('event_id', $event_id)->first();

    // If the event does not exist, return an error
    if (!$event) {
        return redirect()->back()->with('error', 'Event not found.');
    }

    return view('workspace.events.confirm_delete', compact('event'));
}

//profile picture update
public function updateProfilePicture(Request $request)
{
    $request->validate([
        'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = Auth::user();

    // Handle the file upload
    if ($request->hasFile('profile_picture')) {
        // Delete the old profile picture if it exists
        if ($user->profile_picture) {
            // Use the correct path to delete the old profile picture
            Storage::delete('profile_pictures/' . $user->profile_picture);
        }
    
        // Store the new profile picture
        $fileName = time() . '.' . $request->profile_picture->extension();
        $request->profile_picture->storeAs('profile_pictures', $fileName); // Store in 'storage/app/profile_pictures'
    
        // Update the user's profile picture in the database
        $user->profile_picture = $fileName;
        $user->save();
    }
    return redirect()->back()->with('success', 'Profile picture updated successfully.');
}


//deleteing event pictyre

public function destroy($picture_id)
{
    // Find the picture by ID
    $picture = event_picture::findOrFail($picture_id);

    // Check if the logged-in user is the owner of the picture
    if (Auth::user()->id !== $picture->user_id) {
        return redirect()->back()->with('error', 'You are not authorized to delete this picture.');
    }

    // Delete the picture
    $picture->delete();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Picture deleted successfully.');
}


public function storeEventId(Request $request)
{
    // Store the event ID in the session
    $request->session()->put('event_id', $request->input('event_id'));

    return response()->json(['status' => 'success']);
}

public function handleMtnCallback(Request $request)
{
    // Extract necessary data from the request
    $status = $request->input('status');

    // Retrieve the event ID from the session
    $eventId = $request->session()->get('event_id');

    // Check if the transaction was successful
    if ($status === 'success' && $eventId) {
        // Find the event and increment the purchase_count
        $event = event::find($eventId);
        if ($event) {
            $event->purchase_count += 1;
            $event->save();
        }
    }

    // Respond to MTN Ghana
    return response()->json(['status' => 'success']);
}




public function approve($event_id) {
    $event = Event::find($event_id);
    if ($event) {
        $event->approval_flag = 'Y';
        $event->save();
        Toastr::success('Approve successful', 'Event Approval');
    } else {
        Toastr::success('Approve Failure', 'Event Approval');
    }
    return redirect()->back();
}

public function reject($event_id) {
    $event = Event::find($event_id);
    if ($event) {
        $event->approval_flag = 'R';
        $event->save();
        Toastr::success('Reject successful', 'Event Approval');
    } else {
        Toastr::success('Reject Failure', 'Event Approval');
    }
    return redirect()->back();
}


public function approve_Ads($Ad_ID) {
    $ads = advert::find($Ad_ID);
    if ($ads) {
        $ads->status = 'R';
        $ads->save();
        Toastr::success('Approve successful', 'Advert Approval');
    } else {
        Toastr::success('Approve Failure', 'Advert Approval');
    }
    return redirect()->back();
}

public function reject_Ads($Ad_ID) {
    $ads = advert::find($Ad_ID);
    if ($ads) {
        $ads->status = 'N';
        $ads->save();
        Toastr::success('Stop successful', 'Advert Stopping');
    } else {
        Toastr::success('Stop Failure', 'Advert Stopping');
    }
    return redirect()->back();
}



//store advert

public function create_Advert()
{
    $userId = Auth::user()->id; // Get the logged-in user's ID
   // $profilePicturePath = 'images/profile_pictures/default-profile.png'; // Default profile picture

    // Retrieve user's profile picture from the database
    if ($userId) {
        $user = \DB::table('users')->where('id', $userId)->first();
        if ($user) {
            $profilePicturePath = $user->profile_picture;
        }
    }

    return view('workspace.events.add_advert', compact('profilePicturePath'));
}


public function add_advert(Request $request)
{
 
    $flyer_path = $request->file('attach_flyer'); // Get the uploaded file
    $filename = time() . '_' . $flyer_path->getClientOriginalName(); // Create a unique filename
    $path = $flyer_path->storeAs('ads', $filename); 

    // Create a new event
    $adds = new advert(); // Ensure the model name is capitalize
    $adds->Ad_url = $request->add_url;
    $adds->status = 'N';

    $adds->flyer_path = $filename; // Store the filename
    
    $adds->save();

    Toastr::success('Advert successful', 'Advert Creation');
    return redirect()->back()->with('success', 'Add Advert successfully!');
}



//feature event
public function create_feature()
{
    $userId = Auth::user()->id; // Get the logged-in user's ID
   // $profilePicturePath = 'images/profile_pictures/default-profile.png'; // Default profile picture

    // Retrieve user's profile picture from the database
    if ($userId) {
        $user = \DB::table('users')->where('id', $userId)->first();
        if ($user) {
            $profilePicturePath = $user->profile_picture;
        }
    }

    return view('workspace.events.feature', compact('profilePicturePath'));
}

public function feature(Request $request, $event_id) {
    $event = Event::find($event_id); // Ensure 'Event' is correctly capitalized
    if ($event) {
        $event->status = 'featured';
        $event->save();
        Toastr::success('Feature successful', 'Event Feature');
    } else {
        Toastr::error('Feature Failure', 'Event Feature'); // Changed to error for clarity
    }
    return redirect()->back();
}

public function unfeature(Request $request, $event_id) {
    $event = event::find($event_id);
    if ($event) {
        $event->status = 'normal';
        $event->save();
        Toastr::success('Unfeature successful', 'Event Unfeature');
    } else {
        Toastr::success('Feature Failure', 'Event Unfeature');
    }
    return redirect()->back();
}











    /**
        * Create a new controller instance.
        *
        * @return void
        */
    public function __construct()
    {
        $this->middleware('auth');
    }


    // public function dashboard()
    // {
    //     return view('workspace.leave.list');
    // }


    /**
        * Display a listing of the resource.
        *
        * @return Response
        */
   


    /**
        * Show the form for creating a new resource.
        *
        * @return Response
        */
   
   

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
       

  
 
  
    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return Response
        */


    /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return Response
        */

        //
   

    /**
        * Update the specified resource in storage.
        *
        * @param  int  $id
        * @return Response
        */
}