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
                    <th>Country of Arrival</th>
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
    <div id="routeToFlights" data-route="{{ route('flights.index') }}"></div>
    @push('scripts')
        <script src="{{ asset('js/usersFlights.js') }}"></script>
    @endpush
@endsection
