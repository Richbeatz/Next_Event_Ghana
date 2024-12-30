@extends('layouts.dashboard')

@section('content')
<!--Page header-->

<style>
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
    .event-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
}

/* Button Styles */
.btn-social {
    background-color: #ff4757; /* Social media friendly color */
    color: white;
    border: none;
    border-radius: 25px;
    padding: 10px 20px;
    font-size: 16px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn-social:hover {
    background-color: #ff6b81; /* Lighter shade on hover */
    transform: scale(1.05);
}

/* Carousel Image Styles */
.carousel-inner img {
    border-radius: 15px;
}
.event-info {
    font-size: 14px;
    color: #555; /* A softer color for the text */
    margin: 5px 0;
}

/* Event Title Styles */
.card-title {
    font-size: 18px;
    font-weight: bold;
    color: #333; /* Darker color for better readability */
}

/* Carousel Control Styles */
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(255, 255, 255, 0.5); /* Semi-transparent background */
    border-radius: 50%; /* Rounded controls */
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .event-card {
        margin-bottom: 20px; /* More space between cards on smaller screens */
    }

    .btn-social {
        width: 100%; /* Full width button on smaller screens */
    }
}

    </style>
<!--Row-->
<div class="container mt-5">
    <!-- Featured Events Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Featured Events</h2>
        </div>
        <div class="col-md-12">
            <div id="featuredEventsCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($featured_Events as $index => $Event)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <a href="{{ route('event_details', [$Event->event_id, $Event->Events_id]) }}">
                                <img src="{{ url('storage/app/flyers/' . $Event->flyer_path) }}" class="d-block w-100" alt="{{ $Event->event_name }} - Featured Event">
                            </a>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#featuredEventsCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#featuredEventsCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Advert Carousel Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Advertisements</h2>
            <div id="advertCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($advert as $index => $advertItem)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <a href="#">
                                <img src="{{ url('storage/app/ads/' . $advertItem->flyer_path) }}" class="d-block w-100" alt="Advertisement {{ $index + 1 }}">
                            </a>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#advertCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#advertCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Popular Events Section -->
    <div class="row mt-5">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Popular Events</h2>
        </div>
        @foreach($popularEvents as $popular)
            <div class="col-md-4 mb-4">
                <div class="card event-card">
                    <div class="event-content">
                        <a href="{{ route('event_details', [$popular->event_id, $popular->Events_id]) }}">
                            <img class="card-img-top" src="{{ url('storage/app/flyers/' . $popular->flyer_path) }}" alt="{{ $popular->event_name }} - Event Image" style="height: 200px; object-fit: cover;">
                        </a>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $popular->event_name }}</h5>
                        <div class="event-info"><strong>Venue:</strong> {{ $popular->event_venue }}</div>
                        <div class="event-info"><strong>Date:</strong> {{ $popular->event_date }}</div>
                        <div class="event-info"><strong>Time:</strong> {{ $popular->event_time }}</div>
                        <div class="event-info-ratings"><strong>Ratings:</strong> {{ $popular->avg_rating }}</div>
                        @if($popular->ussd_code && \Carbon\Carbon::now()->isBefore($popular->event_date))
    <button class="btn-social" onclick="triggerUSSD('{{ $popular->ussd_code }}', '{{ $popular->event_id }}')">Purchase Ticket</button>
@endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

    

       
 


<script>
function triggerUSSD(ussdCode, eventId) {
    // Store the event ID in the session using an AJAX request
    fetch('/store-event-id', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ event_id: eventId })
    }).then(response => {
        // Open the phone's dialer with the USSD code
        window.location.href = 'tel:' + encodeURIComponent(ussdCode);
    });
}
</script>
@endsection


