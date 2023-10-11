$(document).ready(function () {
    var route = $("#routeToAirlines").data('route');
    var table = $('#myTable').DataTable({

        processing: true,
        serverSide: true,
        ajax: route,
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'flightsNr',
            name: 'flightsNr'
        },
        {
            data: 'deleted_at',
            name: 'deleted_at'
        },
        {
            data: 'action',
            name: 'action'
        },
        ]
        , initComplete: function () {
            $('.edit-button').on('click', function () {
                let modal = $('#editModal');
                modal.find('#update_name').val($(this).data('name'))
                modal.find('#edit-form').attr('action', $(this).data('attr'));
            })
        }

    });
})