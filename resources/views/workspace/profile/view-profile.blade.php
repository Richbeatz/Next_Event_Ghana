@extends('layouts.dashboard')
@section('content')
<div class="container mt-5">
<div class="row mt-8">
    <div class="col-xl-4 col-lg-4">
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

            .card {
                transition: transform 0.2s; /* Animation for card hover */
            }

            .card:hover {
                transform: scale(1.05); /* Scale effect on hover */
            }
        </style>
        <div class="card box-widget widget-user">
       
        
        <div class="widget-user-image mx-auto mt-5 text-center">
    <img class="rounded-circle img-fluid" src="{{ url('storage/app/profile_pictures/' . Auth::user()->profile_picture) }}" alt="Profile Picture" style="width: 190px; height: 190px;">
</div>


            <div class="card-body text-center mb-md-5">
                <div class="pro-user">
                    <h3 class="pro-user-username text-dark">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</h3>
                    <h6 class="pro-user-desc text-muted">{{ Auth::user()->email }}</h6>
                    <h6 class="pro-user-desc text-muted">{{ Auth::user()->phone }}</h6>
                    <span wire:click="updateProfile()" class="badge badge-primary badge-pill">{{-- {{ Auth::user()->type }} --}}</span>
                </div>
                <form action="{{ route('profile.updatePicture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input type="file" name="profile_picture" id="profile_picture" class="form-control-file">
                        <label for="profile_picture" class="btn btn-primary btn-social">
                            <i class="fas fa-upload"></i> Upload Picture
                        </label>
                        <button type="submit" class="btn btn-primary btn-social">
                            <i class="fas fa-check"></i> Update Picture
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer p-0">
                <div class="row">
                    <div class="col-sm-6 border-right text-center">
                        <!-- Additional content can go here -->
                    </div>
                    <div class="col-sm-6">
                        <!-- Additional content can go here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Edit Profile</div>
            </div>
            <form method="POST" action="{{ url('update-profile') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                    <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{ Auth::user()->first_name ?? old('first_name') }}">
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{ Auth::user()->last_name ?? old('last_name') }}">
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" maxlength="10" class="form-control" value="{{ Auth::user()->phone ?? old('phone') }}">
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" value="{{ Auth::user()->email ?? old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="card-footer text-right">
                    <input type="hidden" name="user_id" class="form-control" value="{{ Auth::user()->id }}">
                    <button type="submit" class="btn btn-primary btn-social">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-xl-4 col-lg-4">
        <form method="POST" action="{{ url('update-password') }}">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Password</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Old Password</label>
                        <input type="password" id="current-password" name="current_password" value="{{ old('current_password') }}" class="form-control">
                        @if ($errors->has('current_password'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('current_password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" id="password-confirm" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
                    </div>
                </div>
                <div class="card-footer text-right">
                    <input type="hidden" name="user_id" class="form-control" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="email" class="form-control" value="{{ Auth::user()->email }}">
                    <button type="submit" class="btn btn-primary btn-social">
                        <i class="fas fa-lock"></i> Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
@push('page_css')
@endpush