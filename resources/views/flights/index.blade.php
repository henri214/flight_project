@extends('layouts.app')

@section('content')
{{-- flights page  --}}
    <div class="container mt-5">
        <h2 class="mb-4">Flights</h2>
        <table id="myFlightsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Price</th>
                    <th>Pasangers</th>
                    <th>Two-way Flight</th>
                    <th>Second Departure Time</th>
                    <th>Second Arrival Time</th>
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
                    ajax: "{{ route('flights.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
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
            });
        </script>
    @endpush
@endsection
