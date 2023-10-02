@extends('layouts.app')

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <x-button.create :item="'user'"></x-button.create>
    {{-- admin user table --}}
    <x-table.table :headers="['#', 'Username', 'Email', 'Role Name', 'Phone', 'Age', 'Gender', 'Action']">
        @forelse ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a class="link-underline link-underline-opacity-0"
                        href="{{ route('users.show', $user) }}">{{ $user->username }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role ? 'admin' : 'guest' }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->age }}</td>
                <td>{{ Str::headline($user->gender) }}</td>
                <x-form.form-action :item="'user'" :value="$user" />
            </tr>
        @empty
            <tr>
                <td>1</td>
                <td>There are no Users registered at the moment</td>
            </tr>
        @endforelse
    </x-table.table>
    {{ $users->links() }}
@endsection
