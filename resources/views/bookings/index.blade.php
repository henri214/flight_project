@extends('layouts.app')

@section('content')
    {{-- flights page  --}}
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <x-button.create :item="'booking'"></x-button.create>
    <x-table.table :headers="[
        '#',
        'Flight Name',
        'Departure Time',
        'Arrival Time',
        'Price in $',
        'Two-way Flight',
        'Second Departure Time',
        'Second Arrival Time ',
        'Deleted At',
        'Restore',
        'Action',
        'Delete permanently',
    ]">
        @forelse ($bookings as $booking)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a class="link-underline link-underline-opacity-0"
                        href="{{ route('flights.show', $booking->flight) }}">{{ Str::limit($booking->flight->name, 20) }}</a>
                </td>
                <td width="180px">{{ $booking->flight->departure_time }}</td>
                <td width="180px">{{ $booking->flight->arrival_time }}</td>
                <td>{{ $booking->flight->price }}</td>
                @if ($booking->flight->two_way === 0)
                    <td width="60px">No</td>
                    <td width="50px">--</td>
                    <td width="50px">--</td>
                @else
                    <td width="60px">Yes</td>
                    <td width="150px">{{ $booking->flight->two_way_departure_time }}</td>
                    <td width="150px">{{ $booking->flight->two_way_arrival_time }}</td>
                @endif
                <x-form.form-restore :name="'booking'" :item="$booking" />
                <x-form.form-action :item="'booking'" :value="$booking" />
                <td>
                    <form action="{{ route('bookings.force-delete', $booking) }}" method="Post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-info">Delete Permanently</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td>1</td>
                <td>There are no bookings at the moment</td>
            </tr>
        @endforelse
    </x-table.table>
    {{ $bookings->links() }}
@endsection
