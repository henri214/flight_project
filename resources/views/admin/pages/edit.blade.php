@extends('layouts.app')

@section('content')
    <x-form.form-header :item="'edit page'">
        <form class="form-horizontal" action="{{ route('pages.update', $page) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <x-form.form-input :input="'name'" :type="'text'"></x-form.form-input>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Update</button>
            </div>
        </form>
    </x-form.form-header>
@endsection
