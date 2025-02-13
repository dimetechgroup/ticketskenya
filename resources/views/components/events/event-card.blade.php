{{-- resources/views/components/events/event-card.blade.php --}}
@props(['image', 'date', 'title', 'venue', 'url'])
<div class="col-md-4 mb-4">
    <div class="card shadow-sm event-card">
        <img src="{{ $image }}" class="card-img-top" alt="{{ $title }}">
        <div class="card-body">

            <a href={{ $url }} class="card-title ">{{ $title }}</a>
            <div class="d-flex justify-content-between py-4">
                <p class="text-muted">
                    <i class="fa fa-map text-danger" aria-hidden="true"></i> {{ $venue }}

                </p>
                <span class="badge bg-success">{{ $date }}</span>
            </div>

            <a href={{ $url }} class="btn btn-primary btn-custom-primary">Details & tickets</a>
        </div>
    </div>
</div>
