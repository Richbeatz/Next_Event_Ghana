
@extends('layouts.dashboard')

@section('content')

<form id="event-form" method="post" enctype="multipart/form-data" action="{{ route('updateevent', $events->event_id) }}">
    @csrf

    <div class="form-group organizer">
        <h2>A: ORGANIZER DETAILS</h2>
        <label for="organizer-name">Name:</label>
        <input type="text" id="organizer-name" name="organizer_name" class="form-control" value="{{ old('organizer_name', $events->organizer_name) }}" required>
    </div>

    <h2>B: EVENT DETAILS</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="event-name">Event Name</label>
                <input type="text" id="event-name" name="event_name" class="form-control" value="{{ old('event_name', $events->event_name) }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="event-venue">Venue</label>
                <input type="text" id="event-venue" name="event_venue" class="form-control" value="{{ old('event_venue', $events->event_venue) }}" required>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="event-description">Event Details</label>
        <textarea id="event-description" name="event_description" class="form-control" rows="7" required>{{ old('event_description', $events->event_description) }}</textarea>
    </div>

    <div class="form-group">
        <label for="gps-location">GPS Location</label>
        <input type="text" id="gps-location" name="gps_location" class="form-control" value="{{ old('gps_location', $events->gps_location) }}" required>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="event-date">Event Date</label>
                <input type="date" id="event-date" name="event_date" class="form-control" value="{{ old('event_date', $events->event_date) }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="event-time">Event Time</label>
                <input type="time" id="event-time" name="event_time" class="form-control" value="{{ old('event_time', $events->event_time) }}" required>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="contact-info">Contact Info</label>
        <input type="text" id="contact-info" name="contact_info" class="form-control" value="{{ old('contact_info', $events->contact_info) }}" required>
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
        <textarea id="celebs-list" name="celebs_list" class="form-control" rows="4" readonly>{{ old('celebs_list', $events->celebs_list) }}</textarea>
    </div>

    <div class="form-group">
        <label for="attach-flyer">Attach Flyer</label>
        <div class="input-group">
            <input type="file" id="attach-flyer" name="attach_flyer" class="form-control-file" accept=".pdf, .jpg, .jpeg, .png">
            <label class="input-group-btn" for="attach-flyer">
                <span class="btn btn-social btn-primary">
                    <i class="fas fa-upload"></i> Upload
                </span>
            </label>
        </div>
    </div>

    <div class="text-center mt-4">
        <button type="submit" class="btn btn-social btn-primary">
            <i class="fas fa-save"></i> Update Event
        </button>
    </div>
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
</form>


@endsection
@push('page_js')

<script>
    document.getElementById('add-celeb').addEventListener('click', function() {
        var celebInput = document.getElementById('celebs');
        var celebList = document.getElementById('celebs-list');
        
        if (celebInput.value.trim() !== '') {
            // Append the new celeb to the list
            celebList.value += celebInput.value + '\n';
            celebInput.value = ''; // Clear the input field
        }
    });
</script>



@endpush
