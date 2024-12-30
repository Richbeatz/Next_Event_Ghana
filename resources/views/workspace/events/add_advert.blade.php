@extends('layouts.dashboard')

@section('content')

<main role="main" class="container mt-9" id="content">
        <div class="page" id="add-event">
            <div class="add-event p-4 bg-white border rounded">
            <form id="event-form" method="post" enctype="multipart/form-data" action="{{ route('add_advert') }}">
    @csrf

    <h2>B: ADVERT DETAILS</h2>

    <div class="form-group">
        <label for="contact-info">Ad URL</label>
        <input type="text" id="contact-info" name="add_url" class="form-control" required>
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
        <i class="fas fa-plus-circle"></i> Add Advert
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
