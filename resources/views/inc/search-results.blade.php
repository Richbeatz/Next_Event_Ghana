@if($events->isEmpty())
    <div class="alert alert-warning">No events found.</div>
@else
    <ul class="list-group">
        @foreach($events as $event)
            <li class="list-group-item">
                <strong>{{ $event->event_name }}</strong><br>
                <small>Venue: {{ $event->event_venue }}</small><br>
                <small>Date: {{ $event->event_date }}</small>
            </li>
        @endforeach
    </ul>
@endif