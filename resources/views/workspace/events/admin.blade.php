@extends('layouts.dashboard')

@section('content')
<!--Page header-->

<!--End Page header-->
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


<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-center h-100">
                <a href="{{ url('add_advert') }}" class="text-decoration-none text-dark">
                    <div class="card-body">
                        <h5 class="card-title">Add Advert</h5>
                        <p class="card-text " style = "color:blue;">Click here to add a new advert.</p>
                    </div>
                </a>
            </div>
        </div>
      
        <div class="col-md-4 mb-4">
            <div class="card text-center h-100">
                <a href="{{ url('get_feature') }}" class="text-decoration-none text-dark">
                    <div class="card-body">
                        <h5 class="card-title">Feature</h5>
                        <p class="card-text" style = "color:blue;">Click here to feature Event.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>






<!--Row-->


    <!-- Popular Events Section -->
    <div class="row mt-5">
    <div class="col-md-12">
       
            <div class="card-header text-center">
                <h2 class="mb-0">Pending Events</h2>
            </div>
            <div class="card-body">
                @if($admin->isEmpty())
                    <h5 class="text-center">No Available Events</h5>
                @else
                    <div class="row">
                        @foreach($admin as $admun)
                            <div class="col-md-4 mb-4">
                                <div class="card event-card">
                                    <div class="event-content">
                                        <a href="">
                                            <img class="card-img-top" src="{{ url('storage/app/flyers/' . $admun->flyer_path) }}" alt="Event Image" style="height: 200px; object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $admun->event_name }}</h5>
                                        <div class="event-info"><strong>Venue</strong>: {{ $admun->event_venue }}</div>
                                        <div class="event-info"><strong>Date</strong>: {{ $admun->event_date }}</div>
                                        <div class="event-info"><strong>Time</strong>: {{ $admun->event_time }}</div>
                                        <div class="mt-3">
                                        <div class="d-flex justify-content-center mt-3">
                                            <form action="{{ route('approve', $admun->event_id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success me-2 btn-social">
                                                    <i class="fas fa-check"></i> Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('reject', $admun->event_id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-social">
                                                    <i class="fas fa-times"></i> Reject
                                                </button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        
    </div>







<div class="row mt-5">
    <div class="col-md-12">
       
            <div class="card-header text-center">
                <h2 class="mb-0">Pending Adverts</h2>
            </div>
            <div class="card-body">
                @if($ads->isEmpty())
                    <h5 class="text-center">No Available Adverts</h5>
                @else
                    <div class="row">
                        @foreach($ads as $ads)
                            <div class="col-md-4 mb-4">
                                <div class="card event-card">
                                    <div class="event-content">
                                        <a href="">
                                            <img class="card-img-top" src="{{ url('storage/app/ads/' . $ads->flyer_path) }}" alt="Event Image" style="height: 200px; object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="card-body text-center">
                            
                                    <div class="event-info">
                                        <strong>Status</strong>: 
                                        @if($ads->status === 'R')
                                        Running
                                        @elseif($ads->status === 'N')
                                        Ended
                                        @else
                                        Unknown Status
                                        @endif
                                        </div>                                       
                                        <div class="mt-3">
                                        <div class="d-flex justify-content-center mt-3">
                                    <form action="{{ route('approve_Ads', $ads->Ad_ID) }}" method="POST" class="me-2">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-social">
                                            <i class="fas fa-check"></i> Run
                                        </button>
                                    </form>
                                    <form action="{{ route('reject_Ads', $ads->Ad_ID) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-social">
                                            <i class="fas fa-times"></i> Stop
                                        </button>
                                    </form>
                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
      
    </div>
</div>
    
</div>


@endsection


