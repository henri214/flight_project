@extends('layouts.app')

@section('content')
    {{-- bookings page  --}}
    @can('create', App\Models\Booking::class)
        @include('components.button.create', ['item' => 'booking'])
        @include('bookings.create', ['flights' => $flights, 'pages' => $pages, 'users' => $users])
    @endcan
    <div class="container mt-5">
        <h2 class="mb-4">Bookings</h2>
        <table id="myBookingsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Flight Name</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Price</th>
                    <th>Two Way Flight</th>
                    <th>Second Departure Time</th>
                    <th>Second Arrival Time</th>
                    <th>Deleted At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    @include('bookings.edit')
    <div id="routeToBookings" data-route="{{ route('airlines.index') }}">

    @push('scripts')
        <script type="text/javascript">
            $(function() {
                var table = $('#myBookingsTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{!! route('bookings.index') !!}",
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
                    initComplete: function() {
                        $('.edit-button').on('click', function() {
                            let modal = $('#editModal');
                            modal.find('#user_id').val($(this).data('user_id'))
                            modal.find('#flight_id').val($(this).data('flight_id'))
                            modal.find('#page_id').val($(this).data('page_id'))
                            modal.find('#edit-form').attr('action', $(this).data('attr'));
                        })
                    }
                });
            });
        </script>
    @endpush
@endsection
