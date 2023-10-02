<div class="row justify-content-center mt-5 text-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"> {{ ucwords($item) }}</div>
            <div class="card-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
