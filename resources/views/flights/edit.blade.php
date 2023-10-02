@extends('layouts.app')

@section('content')
    <x-form.form-header :item="'edit flight'">
        <form class="form-horizontal" action="{{ route('flights.update', $flight) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <x-form.form-input :input="'name'" :type="'text'"></x-form.form-input>
                <x-form.form-input :input="'departure_time'" :type="'datetime-local'"></x-form.form-input>
                <x-form.form-input :input="'arrival_time'" :type="'datetime-local'"></x-form.form-input>
                <div class="mb-3 row">
                    <label for="airline_id" class="col-md-4 col-form-label text-md-end text-start">airline_id</label>
                    <div class="col-md-6">
                        <select name="airline_id" id="airline_id" class="form-control">
                            <option value="">Select Airline</option>
                            @foreach ($airlines as $airline)
                                <option value="{{ $airline->id }}">{{ ucwords($airline->name) }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('airline_id'))
                            <span class="text-danger">{{ $errors->first('airline_id') }}</span>
                        @endif
                    </div>
                </div>
                <x-form.form-input :input="'price'" :type="'number'" min="10" max="2000"></x-form.form-input>
                <x-form.form-input :input="'pasangers'" :type="'number'" min="100" max="200"></x-form.form-input>
                <x-form.form-select :input="'is_available'" :description="'Select if the flight is one way or not :'"></x-form.form-select>
                <x-form.form-select :input="'two_way'" :description="'Select if there are available places in this flight :'"></x-form.form-select>
                <div id="show" style="display: none">
                    <x-form.form-input :input="'two_way_departure_time'" :type="'datetime-local'"></x-form.form-input>
                    <x-form.form-input :input="'two_way_arrival_time'" :type="'datetime-local'"></x-form.form-input>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Update</button>
            </div>
        </form>
    </x-form.form-header>
    @push('scripts')
        <script>
            var input = document.getElementById('two_way');
            var show = document.getElementById('show');
            input.addEventListener('change', function handleChange(event) {
                if (event.target.value === '1') {
                    show.style.display = 'block';
                } else {
                    show.style.display = 'none';
                }
            });
        </script>
    @endpush
@endsection
