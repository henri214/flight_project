@extends('layouts.app')

@section('content')
    <x-form.form-header :item="'edit booking'">
        <form class="form-horizontal" action="{{ route('bookings.update', $booking) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <x-form.form-select :input="'user_id'" :description="'Select User'" :items="$users" />
                <x-form.form-select :input="'flight_id'" :description="'Select Flight'" :items="$flights" />
                <x-form.form-select :input="'page_id'" :description="'Select website from :'" :items="$pages" />
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Edit</button>
            </div>
        </form>
    </x-form.form-header>
@endsection
