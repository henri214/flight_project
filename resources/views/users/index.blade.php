@extends('layouts.app')

@section('content')
    
     <x-button.create :item="'user'"></x-button.create>


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
    @push('scripts')
        <script type="text/javascript">
            $(function() {
                var table = $('#myUserTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{!! route('users.index') !!}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'username',
                            name: 'username'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'age',
                            name: 'age'
                        },
                        {
                            data: 'gender',
                            name: 'gender'
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
