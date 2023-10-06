@extends('layouts.app')

@section('content')
    {{-- airline table  --}}
    <x-button.create :item="'airlines'"></x-button.create>
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
    @push('scripts')
        <script type="text/javascript">
            $(function() {
                var table = $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('airlines.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'flightsNr',
                            name: 'flightsNr'
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
