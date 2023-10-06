@extends('layouts.app')

@section('content')
    {{-- bookings page  --}}
    
    <x-button.create :item="'booking'"></x-button.create>
    <div class="container mt-5">
        <h2 class="mb-4">Bookings</h2>
        <table id="myFlightsTable" class="table table-bordered">
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
    @push('scripts')
        <script type="text/javascript">
            $(function() {
                var table = $('#myFlightsTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('bookings.index') }}",
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
                    ]
                });
            });
        </script>
    @endpush
@endsection
