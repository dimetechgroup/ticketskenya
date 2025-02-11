<div class="col-md-3">
    <a class="card card-stats {{ $color }}" href="{{ $route ?? '#' }}">
        <div class="card-body">
            <div class="row">
                <div class="col-5">
                    <div class="icon-big text-center">
                        <i class="{{ $icon }}"></i>
                    </div>
                </div>
                <div class="col-7 d-flex align-items-center">
                    <div class="numbers">
                        <p class="card-category">{{ $category }}</p>
                        <h4 class="card-title">{{ $count }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
