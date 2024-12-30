
@extends('layouts.dashboard')

@section('content')
<main role="main" class="container mt-9" id="content">
        <div class="page" id="add-event">
            <div class="add-event p-4 bg-white border rounded">
            <form id="event-form" method="post" enctype="multipart/form-data" action="{{ route('storeevent') }}">
    @csrf
    <div class="form-group organizer">
        <h2>A: ORGANIZER DETAILS</h2>
        <label for="organizer-name">Name:</label>
        <input type="text" id="organizer-name" name="organizer_name" class="form-control" required>
    </div>

    <h2>B: EVENT DETAILS</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="event-name">Event Name</label>
                <input type="text" id="event-name" name="event_name" class="form-control" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="event-venue">Venue</label>
                <input type="text" id="event-venue" name="event_venue" class="form-control" required>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="event-description">Event Details</label>
        <textarea id="event-description" name="event_description" class="form-control" rows="7" ></textarea>
    </div>

    <div class="form-group">
        <label for="gps-location">GPS Location</label>
        <input type="text" id="gps-location" name="gps_location" class="form-control" >
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="event-date">Event Date</label>
                <input type="date" id="event-date" name="event_date" class="form-control" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="event-time">Event Time</label>
                <input type="time" id="event-time" name="event_time" class="form-control" required>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="contact-info">Contact Info</label>
        <input type="text" id="contact-info" name="contact_info" class="form-control" >
    </div>

    <div class="form-group">
        <label for="celebs">Celebs</label>
        <input type="text" id="celebs" name="celebs" placeholder="Click the add celeb button to append your celeb" class="form-control">
        <button type="button" id="add-celeb" class="btn btn-social btn-secondary mt-2">
            <i class="fas fa-user-plus"></i> Add Celeb
        </button>
    </div>

    <div class="form-group">
        <label for="celebs-list">Celebs List</label>
        <textarea id="celebs-list" name="celebs_list" class="form-control" rows="4" ></textarea>
    </div>

    <div class="form-group">
        <label for="contact-info">USSD Code</label>
        <input type="text" id="contact-info" name="ussd_code" class="form-control" >
    </div>

    <div class="form-group">
    <label for="attach-flyer">Attach Flyer</label>
    <div class="input-group">
        <input type="file" id="attach-flyer" name="attach_flyer" class="form-control-file" accept=".pdf, .jpg, .jpeg, .png" required>
        <label class="input-group-btn" for="attach-flyer">
            <span class="btn btn-social btn-primary">
                <i class="fas fa-upload"></i> Upload
            </span>
        </label>
    </div>
</div>

<div class="text-center mt-4">
    <button type="submit" class="btn btn-social btn-primary">
        <i class="fas fa-plus-circle"></i> Add Event
    </button>
</div>
</form>

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

    /* Style for the file input group */
    .input-group {
        display: flex;
        align-items: center;
    }

    .form-control-file {
        display: none; /* Hide the default file input */
    }

    .input-group .btn {
        margin-left: 10px; /* Space between file input and button */
    }

    /* Optional: Style for the file input label */
    .input-group .btn-primary {
        border-radius: 30px; /* Rounded corners for the upload button */
        padding: 10px 20px; /* Padding for the button */
        transition: background-color 0.3s, transform 0.3s; /* Smooth transition for hover effects */
    }

    /* Optional: Style for the form inputs */
    .form-control {
        border-radius: 20px; /* Rounded corners for inputs */
        transition: border-color 0.3s; /* Smooth transition for border color */
    }

    .form-control:focus {
        border-color: #0056b3; /* Change border color on focus */
        box-shadow: 0 0 5px rgba(0, 86, 179, 0.5); /* Add shadow on focus */
    }
</style>
            </div>
        </div>
    </main>

@endsection





@push('page_js')
  

<script>
        const celebsInput = document.getElementById('celebs');
        const celebsList = document.getElementById('celebs-list');
        const addCelebButton = document.getElementById('add-celeb');

        let celebs = [];

        addCelebButton.addEventListener('click', () => {
            const celebName = celebsInput.value.trim();
            if (celebName !== '') {
                celebs.push(celebName);
                updateCelebsList();
                celebsInput.value = '';
            }
        });

        function updateCelebsList() {
            celebsList.value = celebs.join('\n');
        }
    </script>
    



       
   
    </script>
















