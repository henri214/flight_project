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
                <x-form.form-select :input="'airline_id'" :description="'Select Airline'" :items="$airlines" />
                <x-form.form-input :input="'price'" :type="'number'" min="10" max="2000"></x-form.form-input>
                <x-form.form-input :input="'pasangers'" :type="'number'" min="100" max="200"></x-form.form-input>
                <x-form.form-select :input="'is_available'" :description="'Select if the flight is one way or not :'" :items="$availability" />

                <x-form.form-select :input="'two_way'" :description="'Select if there are available places in this flight :'" :items="$two_way" />
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
