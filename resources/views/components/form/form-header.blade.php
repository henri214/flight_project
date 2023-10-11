<div class="modal fade row justify-content-center mt-5 text-center" role="dialog" id="modal" aria-hidden="true">
    <div class="modal-dialog col-md-8" role="document">
        <div class="modal-content">
            <div class="modal-header" id="#modal"> {{ ucwords($item) }}</div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>