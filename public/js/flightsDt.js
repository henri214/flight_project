$(document).ready(function () {
    var route = $("#routeToAdminFlights").data('route');

    var table = $('#myFlightsTable').DataTable({
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
            data: 'country_to',
            name: 'country_to'
        },
        {
            data: 'departure_time',
            name: 'departure_time'
        },
        {
            data: 'arrival_time',
            name: 'arrival_time'
        },
        {
            data: 'price',
            name: 'price'
        },
        {
            data: 'pasangers',
            name: 'pasangers'
        },
        {
            data: 'twoWay',
            name: 'twoWay'
        },
        {
            data: 'two_way_departure_time',
            name: 'two_way_departure_time'
        },
        {
            data: 'two_way_arrival_time',
            name: 'two_way_arrival_time'
        },
        {
            data: 'deleted_at',
            name: 'deleted_at'
        },

        {
            data: 'action',
            name: 'action',
            searchable: false,
            orderable: false
        },
        ],
        initComplete: function () {
            $('.edit-button').on('click', function () {
                let modal = $('#editModal');
                modal.find('#update-name').val($(this).data('name'))
                modal.find('#country_to').val($(this).data('country_to'))
                modal.find('#departure_time').val($(this).data('departure_time'))
                modal.find('#arrival_time').val($(this).data('arrival_time'))
                modal.find('#airline_id').val($(this).data('airline_id'))
                modal.find('#price').val($(this).data('price'))
                modal.find('#pasangers').val($(this).data('pasangers'))
                modal.find('#is_available').val($(this).data('is_available'))
                modal.find('#two_way').val($(this).data('two_way'))
                modal.find('#two_way_departure_time').val($(this).data(
                    'two_way_departure_time'))
                modal.find('#two_way_arrival_time').val($(this).data(
                    'two_way_arrival_time'))
                modal.find('#edit-form').attr('action', $(this).data('attr'));
                let show = modal.find('#show');
                modal.find('#two_way').on('change', function () {
                    if ($(this).val() === '1') {
                        show.css("display", 'block');
                    } else {
                        show.css("display", 'none');
                    }
                });
            });
        }
    });

})