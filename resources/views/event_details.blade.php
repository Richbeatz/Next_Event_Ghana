@extends('layouts.dashboard')

@section('content')
    <h2 class="text-center mb-4">Event Details</h2>

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

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
                <img class="card-img-top" src="{{ url('storage/app/flyers/' . $event->flyer_path) }}" alt="Event Image">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-primary">{{ $event->event_name }}</h5>
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <div class="mb-3">
                                <p class="card-text"><strong>Venue:</strong> <span class="text-muted">{{ $event->event_venue }}</span></p>
                            </div>
                            <div class="mb-3">
                                <p class="card-text"><strong>Location:</strong> <span class="text-muted">{{ $event->gps_location }}</span></p>
                            </div>
                            <div class="mb-3">
                                <p class="card-text"><strong>Date:</strong> <span class="text-muted">{{ $event->event_date }}</span></p>
                            </div>
                            <div class="mb-3">
                                <p class="card-text"><strong>Time:</strong> <span class="text-muted">{{ $event->event_time }}</span></p>
                            </div>
                            <div class="mb-3">
                                <p class="card-text"><strong>Organizer:</strong> <span class="text-muted">{{ $event->organizer_name }}</span></p>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="mb-3">
                                <p class="card-text"><strong>Contact:</strong> <span class="text-muted">{{ $event->contact_info }}</span></p>
                            </div>
                            <div class="mb-3">
                                <p class="card-text"><strong>Event Description:</strong><br><span class="text-muted">{{ $event->event_description }}</span></p>
                            </div>
                            
                        </div>
                    </div>
                    <a href="{{ url('storage/app/flyers/' . $event->flyer_path) }}" download class="btn btn-primary mt-3 btn-social">
                        <i class="fas fa-download"></i> Download Flyer
                    </a>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>

<div class="card mb-2"> <!-- Reduced margin-bottom -->
    <div class="card-body text-center"> <!-- Center text within the card body -->
        <div class="event-ratings mb-4">
            <h2 class="mb-3">Ratings</h2>
            <div id="average-rating" class="mb-3">
                <strong>Average Rating:</strong> <span class="h5">{{ $averageRating }}</span>
            </div>
            <div class="mb-4">
                <div class="d-flex justify-content-center align-items-center mb-2"> <!-- Center the progress bar -->
                    <div class="progress w-75">
                        @php
                            $percentage = ($averageRating / 5) * 100; // Assuming 5 is the max rating
                        @endphp
                        <div id="rating-bar" class="progress-bar bg-primary" role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="{{ $averageRating }}" aria-valuemin="0" aria-valuemax="5"></div>
                        <span class="progress-value position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%); color: black;">{{ round($percentage) }}%</span>
                    </div>
                </div>
            </div>

            <div class="rate-content mt-3 d-flex justify-content-center align-items-center"> <!-- Center the rating controls -->
                <label for="user-rating" class="mr-2">Rate this event:</label>
                <select id="user-rating" class="form-control d-inline-block w-auto mx-2"> <!-- Add margin for spacing -->
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button id="submitRatingButton" class="btn btn-success btn-social">
                    <i class="fas fa-paper-plane"></i> Submit
                </button>
            </div>
        </div>
    </div>
   
</div>


<div class="container mt-2"> <!-- Reduced margin-top -->
    <div class="card mb-2"> <!-- Reduced margin-bottom -->
        <div class="event-gallery">
      
            
            <div class="row mb-0">
                <div class="col-md-2 text-center">
                <h1>Event Pictures</h1>
                    <button class="btn btn-social" id="add-picture-icon"><i class="fas fa-camera"></i> Add Picture</button>
                </div>
            </div>
            <div class="card-header text-center">
            </div>
            <div class="card-body">
                <form id="picture-upload-form" action="{{ route('event.picture.upload') }}" method="POST" enctype="multipart/form-data" class="mb-1">
                    @csrf
                    <div class="form-group">
                        <label for="picture" class="font-weight-bold mt-1">Choose a Picture</label>
                        <div class="input-group">
                            <input type="file" name="picture" id="picture" class="form-control-file" required>
                            <label for="picture" class="btn btn-primary btn-social">
                                <i class="fas fa-upload"></i> Choose File
                            </label>
                            <input type="hidden" name="event_id" id="event_id" value="{{ $event->event_id }}">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" id="upload-button" class="btn btn-primary btn-social mr-2">
                            <i class="fas fa-paper-plane"></i> Upload Picture
                        </button>
                        <button type="button" id="close-form-icon" class="btn btn-danger btn-social">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   

</div>

<div class="card mb-2"> <!-- Reduced margin-bottom -->
    <div class="container">
        <div class="col-md-2 text-center">
            <h2 class="text-center mb-0">Event Gallery</h2>
        </div>
        <div class="row">
            @if($eventPictures->isEmpty())
                <div class="col-12">
                    <p>No posts yet!</p>
                </div>
            @else
                @foreach($eventPictures as $picture)
                    <div class="col-md-4">
                        <img src="{{ url('storage/app/posts/' . $picture->picture_path) }}" class="card-img-top" alt="Event Picture" 
                             data-toggle="modal" data-target="#imageModal{{ $picture->picture_id }}" 
                             style="cursor: pointer;">
                        <div class="d-flex justify-content-center align-items-center">
                        <div class="me-5">
    <i class="far fa-thumbs-up icon-large like-icon" style="font-size: 20px" data-picture-id="{{ $picture->picture_id }}"></i>
    <span class="like-count" style="font-size: 20px">{{ $picture->like_count > 0 ? $picture->like_count : 0 }}</span>
</div>
                            <div class="comment-icon-large" style="font-size: 20px; margin-left:10%" data-picture-id="{{ $picture->picture_id }}" data-toggle="modal" data-target="#commentsModal{{ $picture->picture_id }}">
                                <i class="far fa-comment"></i>
                                <span class="comment-count" style="font-size: 20px">{{ $picturesWithComments[$picture->picture_id]['comment_count'] ?? 0 }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for displaying the image -->
                    <div class="modal fade" id="imageModal{{ $picture->picture_id }}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel{{ $picture->picture_id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel{{ $picture->picture_id }}">Event Picture</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ url('storage/app/posts/' . $picture->picture_path) }}" class="img-fluid" alt="Event Picture">
                                    @if(auth()->user()->id === $picture->user_id) <!-- Check if the logged-in user is the owner -->
                                        <form action="{{ route('eventPictures.destroy', $picture->picture_id) }}" method="POST" class="mt-3">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<hr>

@foreach ($picturesWithComments as $pictureId => $pictureData)
    <!-- Modal -->
    <div class="modal fade" id="commentsModal{{ $pictureId }}" tabindex="-1" role="dialog" aria-labelledby="commentsModalLabel{{ $pictureId }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                    <div class="comments-section" id="commentsContainer{{ $pictureId }}">
                        @if ($pictureData['comment_count'] > 0)
                            @foreach ($pictureData['comment_texts'] as $index => $commentText)
                            <style>
                                    .comment-bubble {
                                        background-color: #e9ecef; /* Light gray background for comments */
                                        border-radius: 20px; /* Rounded corners */
                                        max-width: 70%; /* Limit the width of the comment bubble */
                                    }
                                    .timestamp-bubble {
                                        background-color: #f8f9fa; /* Light background for timestamps */
                                        border-radius: 20px; /* Rounded corners */
                                        max-width: 25%; /* Limit the width of the timestamp bubble */
                                        text-align: center; /* Center the text */
                                    }
                                </style>  
                                <div class="comment-bubble p-2 mb-3">
                                    <small class="text-muted">{{ $pictureData['usernames'][$pictureData['user_ids'][$index]] ?? 'Unknown User' }}</small>
                                    <p class="mb-0">{{ $commentText }}</p>
                                    <div class="timestamp-bubble mt-1" style="margin-left: 60%;">
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($pictureData['timestamps'][$index])->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">No comments yet.</p>
                        @endif
                    </div>
                </div>
                <form class="comment-form">
                    <input type="hidden" name="picture_id" id="pic_id" value="{{ $pictureData['picture_id'] }}">
                    <hr />
                    <div class="d-flex">
                        <input type="text" name="comment_text" placeholder="Add a comment..." required class="form-control me-2">
                        <button type="submit" class="btn btn-primary btn-social">Add comment</button>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-social" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

</div>
    </div>

@endsection

@push('page_js')
<script>
   document.getElementById('submitRatingButton').addEventListener('click', function() {
    const rating = document.getElementById('user-rating').value;
    const eventId = {{ $event->event_id }}; // Assuming you have the event ID available in your view
    const userId = {{ Auth::user()->id }}; // Assuming you are using Laravel's Auth system
   
    // Check if the user has already rated the event (https://nexteventghana.com)
    fetch(`/Next_Event_Ghana/events/${eventId}/check-rating/${userId}`)
        .then(response => response.json())
        .then(data => {
            if (data.hasRated) {
                toastr.info('You have already rated this event.', 'Rating Info');
            } else {
                // Submit the rating  (https://nexteventghana.com)
                fetch(`/Next_Event_Ghana/events/${eventId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for security
                    },
                    body: JSON.stringify({ rating: rating, userId: userId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Optionally, update the average rating and progress bar here
                        // Update the average rating display
                        const averageRating = data.averageRating;
                        const percentage = (averageRating / 5) * 100; // Assuming 5 is the max rating
                        document.getElementById('rating-bar').style.width = `${percentage}%`;
                        document.querySelector('.progress-value').textContent = `${Math.round(percentage)}%`;
                        toastr.success('Your rating has been submitted successfully!', 'Success');
                    } else {
                        toastr.error('There was an error submitting your rating. Please try again.', 'Error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error('There was an error submitting your rating. Please try again.', 'Error');
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('There was an error checking your rating. Please try again.', 'Error');
        });
});

    // Upload picture open modal
    document.getElementById('add-picture-icon').addEventListener('click', function() {
        document.getElementById('picture-upload-form').style.display = 'block';
    });

    document.getElementById('close-form-icon').addEventListener('click', function() {
        document.getElementById('picture-upload-form').style.display = 'none';
    });

    // Comment modal pop up
    document.querySelectorAll('.comment-icon-large').forEach(function(element) {
        element.addEventListener('click', function() {
            const pictureId = this.getAttribute('data-picture-id');
            const modal = new bootstrap.Modal(document.getElementById('myModal'));
            modal.show();
            // Load comments for the specific picture
            loadComments(pictureId);
        });
    });

    function loadComments(pictureId) {
        // Fetch comments for the specific picture
        fetch(`/pictures/${pictureId}/comments`)
            .then(response => response.json())
            .then(data => {
                const commentsContainer = document.getElementById(`commentsContainer${pictureId}`);
                commentsContainer.innerHTML = ''; // Clear existing comments
                data.comments.forEach(comment => {
                    const commentBubble = document.createElement('div');
                    commentBubble.className = 'comment-bubble p-2 mb-3';
                    commentBubble.innerHTML = `
                        <small class="text-muted">${comment.username}</small>
                        <p class="mb-0">${comment.comment_text}</p>
                        <div class="timestamp-bubble mt-1" style="margin-left: 60%;">
                            <small class="text-muted">${comment.timestamp}</small>
                        </div>
                    `;
                    commentsContainer.appendChild(commentBubble);
                });
            });
    }


    //save comments
    $(document).on('submit', '.comment-form', function(e) {
    e.preventDefault(); // Prevent the default form submission

    var form = $(this);
    var pictureId = form.find('input[name="picture_id"]').val(); // Get the picture_id from the hidden input
    var commentText = form.find('input[name="comment_text"]').val();
    
    $.ajax({
        url: '/Next_Event_Ghana/comments', // (https://nexteventghana.com)               Your route to handle comment submission
        method: 'POST',
        data: {
            picture_id: pictureId,
            comment_text: commentText,
            user_id: {{ auth()->user()->id }}, // Assuming you have user authentication
            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
        },
        success: function(response) {
            if (response.success) {
                // Clear the input field
                form.find('input[name="comment_text"]').val('');

                // Update the comment count
                $('#commentCount' + pictureId).text(response.comment_count); // Update the comment count display

                // Prepend the new comment to the comments container
                var commentsContainer = $('#commentsContainer' + pictureId);
                commentsContainer.prepend(`
                    <div class="comment-bubble p-2 mb-3">
                        <small class="text-muted">You</small>
                        <p class="mb-0">${commentText}</p>
                        <div class="timestamp-bubble mt-1" style="margin-left: 60%;">
                            <small class="text-muted">Just now</small>
                        </div>
                    </div>
                `);
            } else {
                console.error('Comment submission failed:', response.message);
            }
        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });
});


//submit like 
$(document).on('click', '.like-icon', function() {
    var pictureId = $(this).data('picture-id'); // Get the picture ID from the data attribute
    const userId = {{ auth()->user()->id }}; // Assuming you have user authentication
    var iconElement = $(this); // Reference to the clicked icon

    $.ajax({
        url: '/Next_Event_Ghana/like', // (https://nexteventghana.com)                    Your route to handle like submission
        method: 'POST',
        data: {
            picture_id: pictureId,
            user_id: userId,
            _token: '{{ csrf_token() }}' // Include CSRF token for security
        },
        success: function(response) {
            if (response.success) {
                // Update the like count on the page
                var likeCountElement = $('.like-count').filter(function() {
                    return $(this).siblings('.like-icon').data('picture-id') == pictureId;
                });

                // Increment the like count displayed on the page
                var currentCount = parseInt(likeCountElement.text());
                likeCountElement.text(currentCount + 1); // Update the displayed like count

                // Change the icon to filled
                iconElement.removeClass('far fa-thumbs-up').addClass('fas fa-thumbs-up');
            } else {
                // Show toastr notification if already liked
                toastr.info(response.message || "You have already liked this picture.");
            }
        }.bind(this), // Bind 'this' to the success function to access the clicked element
        error: function(xhr) {
            console.error(xhr.responseText);
            // Change alert to toastr info alert
           
        }
    });
});
</script>
@endpush