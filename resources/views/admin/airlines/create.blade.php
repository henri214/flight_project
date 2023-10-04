@extends('layouts.app')

@section('content')
    <x-form.form-header :item="'create airline'">
        <form class="form-horizontal" action="{{ route('airlines.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <x-form.form-input :input="'name'" :type="'text'"></x-form.form-input>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Create</button>
            </div>
        </form>
    </x-form.form-header>
@endsection
