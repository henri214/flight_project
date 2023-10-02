@extends('layouts.app')

@section('content')
    {{-- Page table  --}}
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <x-table.table :headers="['#', 'Name', 'All Users', 'All Bookings', 'Action']">
        @forelse ($pages as $page)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a class="link-underline link-underline-opacity-0"
                        href="{{ route('pages.show', $page) }}">{{ Str::limit($page->name, 20) }}</a></td>
                <td>{{ $page->users->count() }}</td>
                <td>{{ $page->bookings->count() }}</td>
                <td>
                    <form action="{{ route('pages.destroy', $page) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('pages.edit', $page) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>

            </tr>
        @empty
            <tr>
                <td>1</td>
                <td>There are no pages at the moment</td>
            </tr>
        @endforelse
    </x-table.table>
    {{ $pages->links() }}
@endsection
