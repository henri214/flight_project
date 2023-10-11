@extends('layouts.app')

@section('content')
    @include('components.button.create', ['item' => 'user'])
    @include('users.create', [
        'roles' => $roles,
        'pages' => $pages,
        'genders' => $genders,
    ])


    <div class="container mt-5">
        <h2 class="mb-4">Users</h2>
        <table id="myUserTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role Name</th>
                    <th>Phone</th>
                    <th>Page id</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Deleted at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    @include('users.edit')
    <div id="routeToUsers" data-route="{{ route('users.index') }}"></div>
    @push('scripts')
        <script src="{{ asset('js/users.js') }}"></script>
    @endpush
@endsection
