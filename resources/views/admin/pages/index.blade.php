@extends('layouts.app')

@section('content')
    {{-- Page table  --}}
    @include('components.button.create', ['item' => 'page'])
    @include('admin.pages.create')
    <div class="container mt-5">
        <h2 class="mb-4">Pages</h2>
        <table id="myTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Page Name</th>
                    <th>Users</th>
                    <th>Bookings</th>
                    <th>Deleted at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    @include('admin.pages.edit')
    <div id="routeToPages" data-route="{{ route('pages.index') }}"></div>
    @push('scripts')
        <script src="{{ asset('js/pages.js') }}"></script>
    @endpush
@endsection
