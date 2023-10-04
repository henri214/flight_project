@extends('layouts.app')

@section('content')
    {{-- airline table  --}}
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <x-button.create :item="'airlines'"></x-button.create>
    <x-table.table :headers="['#', 'Airline Name', 'All Flights', 'Deleted At', 'Restore', 'Action']">
        @forelse ($airlines as $airline)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a class="link-underline link-underline-opacity-0"
                        href="{{ route('airlines.show', $airline) }}">{{ Str::limit($airline->name, 20) }}</a></td>
                <td>{{ $airline->flights->count() }}</td>
                <x-form.form-restore :name="'airline'" :item="$airline" />
                <x-form.form-action :item="'airline'" :value="$airline" />
            </tr>
        @empty
            <tr>
                <td>1</td>
                <td>There are no airlines at the moment</td>
            </tr>
        @endforelse
    </x-table.table>
    {{ $airlines->links() }}
@endsection
