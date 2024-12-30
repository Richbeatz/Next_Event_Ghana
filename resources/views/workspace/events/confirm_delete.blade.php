@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h2 class="text-danger">Confirm Deletion</h2>
        </div>
        <div class="card-body">
            <p class="lead text-center">Are you sure you want to delete the event: <strong>{{ $event->event_name }}</strong>?</p>

            <form action="{{ route('events.delete', $event->event_id) }}" method="POST" class="mt-4 text-center">
                @csrf
                @method('DELETE') <!-- Use DELETE method for the form -->
                
                <div class="form-group">
                    <button type="submit" class="btn btn-danger btn-lg">
                        <i class="fas fa-trash-alt"></i> Yes, Delete
                    </button>
                    <a href="{{ route('posts') }}" class="btn btn-secondary btn-lg ml-2">
                        <i class="fas fa-times"></i> Cancel
                    </a> <!-- Cancel button -->
                </div>
            </form>
        </div>
    </div>
</div>
@endsection