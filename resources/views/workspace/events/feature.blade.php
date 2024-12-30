@extends('layouts.dashboard')

@section('content')
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
.card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .icon {
            font-size: 50px;
            color: #007bff;
            transition: color 0.3s;
        }

        .icon:hover {
            color: #0056b3;
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



 <div class="row mt-5">
    <div class="col-md-12">
        <div class="card-header text-center">
            <h2 class="mb-0">All Events</h2>
        </div>
        <div class="card-body">
            @if($feature->isEmpty())
                <h5 class="text-center">No Available Events</h5>
            @else
                <!-- Search Field -->
                <div class="mb-4">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search events..." onkeyup="filterEvents()">
                </div>
                <div class="row" id="eventList">
    @foreach($feature as $event)
        <div class="col-md-4 mb-4 event-item">
            <div class="card event-card">
                <div class="event-content">
                    <a href="">
                        <img class="card-img-top" src="{{ url('storage/app/flyers/' . $event->flyer_path) }}" alt="Event Image" style="height: 200px; object-fit: cover;">
                    </a>
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $event->event_name }}</h5>
                    <div class="event-info"><strong>Venue</strong>: {{ $event->event_venue }}</div>
                    <div class="event-info"><strong>Date</strong>: {{ $event->event_date }}</div>
                    <div class="event-info"><strong>Time</strong>: {{ $event->event_time }}</div>
                    <!-- Other content -->
                </div>
            </div>
        </div>
    @endforeach
</div>
            @endif
        </div>
    </div>
</div>





@endsection


@push('page_js')

<script>
 function filterEvents() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase().trim(); // Trim whitespace
    console.log("Search filter:", filter); // Debugging line
    const eventList = document.getElementById('eventList');
    const events = eventList.getElementsByClassName('event-item');

    // If the input is empty, show all events
    if (filter === "") {
        for (let i = 0; i < events.length; i++) {
            events[i].style.display = ""; // Show all events
        }
        return; // Exit the function
    }

    for (let i = 0; i < events.length; i++) {
        const title = events[i].getElementsByClassName('card-title')[0].textContent.toLowerCase();
        const venue = events[i].getElementsByClassName('event-info')[0].textContent.toLowerCase();
        const date = events[i].getElementsByClassName('event-info')[1].textContent.toLowerCase();
        const time = events[i].getElementsByClassName('event-info')[2].textContent.toLowerCase();

        console.log("Event:", title, venue, date, time); // Debugging line

        // Check if the filter matches any of the event details
        if (title.includes(filter) || venue.includes(filter) || date.includes(filter) || time.includes(filter)) {
            events[i].style.display = ""; // Show the event
        } else {
            events[i].style.display = "none"; // Hide the event
        }
    }
}

</script>
@endpush