
$(function () {
    var route = $("#routeToBookings").data('route');
    var table = $('#myBookingsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: route,
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'flight.name',
            name: 'flight.name'
        },
        {
            data: 'flight.departure_time',
            name: 'flight.departure_time'
        },
        {
            data: 'flight.arrival_time',
            name: 'flight.arrival_time'
        },
        {
            data: 'flight.price',
            name: 'flight.price'
        },
        {
            data: 'twoWay',
            name: 'twoWay'
        },
        {
            data: 'secondDepartureTime',
            name: 'secondDepartureTime'
        },
        {
            data: 'secondArrivalTime',
            name: 'secondArrivalTime'
        },
        {
            data: 'deleted_at',
            name: 'deleted_at'
        },
        {
            data: 'action',
            name: 'action'
        },
        ],
        initComplete: function () {
            $('.edit-button').on('click', function () {
                let modal = $('#editModal');
                modal.find('#user_id').val($(this).data('user_id'))
                modal.find('#flight_id').val($(this).data('flight_id'))
                modal.find('#page_id').val($(this).data('page_id'))
                modal.find('#edit-form').attr('action', $(this).data('attr'));
            })
        }
    });
});