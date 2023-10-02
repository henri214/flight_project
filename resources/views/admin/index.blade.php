@extends('layouts.app')

@section('content')
    {{-- admin welcome page --}}
    <x-button.create :item="'flight'"></x-button.create>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <x-table.table :headers="[
        '#',
        'Name',
        'Airline',
        'Departure Time',
        'Arrival Time',
        'Price in $',
        'Pasangers',
        'Second Departure Time',
        'Second Arrival Time ',
        'Two-way Flight',
        'Is Available',
        'Action',
    ]">
        @forelse ($flights as $flight)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a class="link-underline link-underline-opacity-0"
                        href="{{ route('flights.show', $flight) }}">{{ Str::limit($flight->name, 20) }}</a></td>
                <td>{{ Str::limit($flight->airline->name, 20) }}</td>
                <td width="150px">{{ $flight->departure_time }}</td>
                <td width="150px">{{ $flight->arrival_time }}</td>
                <td>{{ $flight->price }}</td>
                <td>{{ $flight->pasangers }}</td>
                <td width="150px">{{ $flight->two_way_departure_time }}</td>
                <td width="150px">{{ $flight->two_way_arrival_time }}</td>
                @if ($flight->two_way === 0)
                    <td>False</td>
                @else
                    <td>True</td>
                @endif
                @if ($flight->is_available === 0)
                    <td>False</td>
                @else
                    <td>True</td>
                @endif
                </td>
                <x-form.form-action :item="'flight'" :value="$flight" />
            </tr>
        @empty
            <tr>
                <td>1</td>
                <td>There are no flights at the moment</td>
            </tr>
        @endforelse
    </x-table.table>
    {{ $flights->links() }}
@endsection
