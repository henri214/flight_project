@extends('layouts.app')

@section('content')
    {{-- airline table  --}}
    @include('components.button.create', ['item' => 'airlines'])
    @include('admin.airlines.create')
    <div class="container mt-5">
        <h2 class="mb-4">Airlines</h2>
        <table id="myTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Airline Name</th>
                    <th>All Flights</th>
                    <th>Deleted At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    @include('admin.airlines.edit')
    <div id="routeToAirlines" data-route="{{ route('airlines.index') }}">

        @push('scripts')
            <script src="{{ asset('js/airlines.js') }}"></script>
        @endpush
    @endsection
