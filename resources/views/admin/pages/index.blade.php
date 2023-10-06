@extends('layouts.app')

@section('content')
    {{-- Page table  --}}
    <x-button.create :item="'page'"></x-button.create>
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
    @push('scripts')
        <script type="text/javascript">
            $(function() {
                var table = $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('pages.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'allUsers',
                            name: 'allUsers'
                        },
                        {
                            data: 'bookings',
                            name: 'bookings'
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
