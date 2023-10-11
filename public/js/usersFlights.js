$(document).ready(function () {
    var route = $("#routeToFlights").data('route');

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
            data: 'secondDepartureTime',
            name: 'secondDepartureTime'
        },
        {
            data: 'secondArrivalTime',
            name: 'secondArrivalTime'
        },
        {
            data: 'action',
            name: 'action'
        },
        ]

    });
})