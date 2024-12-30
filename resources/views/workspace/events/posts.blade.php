@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
<div id="content">
    <div id="main-content">
        <div class="page" id="view-events">
            <h1 class="text-center mb-4 blinkinng-text">My Posts</h1>
            <div class="row">
                @foreach($events as $event)
                <div class="col-md-4 mb-4">
    <div class="card event-card">
        <a href="{{ route('event_details', ['event_id' => $event->event_id, 'Events_id' => $event->Events_id]) }}">
            <img class="card-img-top" src="{{ url('storage/app/flyers/' . $event->flyer_path) }}" alt="Event Image" style="height: 200px; object-fit: cover;">
        </a>
        <div class="card-body text-center">
            <h5 class="card-title">{{ $event->event_name }}</h5>
            <div class="event-info"><strong>Venue:</strong> {{ $event->event_venue }}</div>
            <div class="event-info"><strong>Date:</strong> {{ $event->event_date }}</div>
            <div class="event-info"><strong>Time:</strong> {{ $event->event_time }}</div>

            <div class="d-flex justify-content-center mt-2">
                <a href="{{ route('edit',['event_id' => $event->event_id])}}" class="btn btn-social btn-primary me-2"> 
                    <i class="fas fa-edit"></i> Edit
                </a>

                <a href="{{ route('event_details', ['event_id' => $event->event_id, 'Events_id' => $event->Events_id]) }}" class="btn btn-social btn-primary me-2">
                    <i class="fas fa-info-circle"></i> Details
                </a>
                <a href="{{ route('events.confirmDelete', ['event_id' => $event->event_id]) }}" class="btn btn-social btn-primary">
    <i class="fas fa-trash-alt"></i> Delete
</a>
            </div>
        </div>
    </div>
</div>
                @endforeach

                @if($events->isEmpty())
                    <div class="col-12">
                        <p class="text-center">No Posts yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
<style>
    .blinking-text {
        color: green; /* Set the text color to green */
        animation: blink 1s infinite; /* Apply the blinking animation */
    }

    @keyframes blink {
        0% { opacity: 1; }
        50% { opacity: 0; }
        100% { opacity: 1; }
    }

    .event-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .event-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .event-card:active {
        transform: scale(0.98);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .btn-social {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        border-radius: 30px; /* Rounded corners */
        font-weight: bold;
        transition: background-color 0.3s, transform 0.3s;
    }

    .btn-social i {
        margin-right: 8px; /* Space between icon and text */
    }

    .btn-social:hover {
        background-color: #0056b3; /* Darker shade on hover */
        transform: scale(1.05); /* Slightly enlarge on hover */
    }

    .btn-social:active {
        transform: scale(0.95); /* Slightly shrink on click */
    }
</style>

@endsection
@push('page_js')
    <script src="{{ asset('theme/views_js/live_note.js')}}"></script>
    <script src="{{ asset('theme/views_js/silent_poster.js')}}"></script>
@endpush
@push('page_js')
<script>




</script>
@endpush
