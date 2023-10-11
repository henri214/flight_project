@extends('layouts.app')

@section('content')
    {{-- admin flights page --}}
    @include('components.button.create', ['item' => 'flight'])
    @include('flights.create', [
        'airlines' => $airlines,
        'availability' => $availability,
        'twoWay' => $twoWay,
    ])
    <div class="container mt-5">
        <h2 class="mb-4">Flights</h2>
        <table id="myFlightsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Country To</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Price</th>
                    <th>Pasangers</th>
                    <th>Two-way Flight</th>
                    <th>Second Departure Time</th>
                    <th>Second Arrival Time</th>
                    <th>Deleted at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>


    </div>
    @include('flights.edit')
    <div id="routeToAdminFlights" data-route="{{ route('admin.index') }}">

    @push('scripts')
        <script src="{{ asset('js/flightsDt.js') }}"></script>
    @endpush
@endsection
