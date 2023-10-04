@extends('layouts.app')

@section('content')
    <x-form.form-header :item="'edit user'">
        <form class="form-horizontal" action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.form-input :input="'username'" :type="'text'"></x-form.form-input>
            <x-form.form-input :input="'email'" :type="'email'"></x-form.form-input>
            <x-form.form-input :input="'birthday'" :type="'number'"></x-form.form-input>
            <x-form.form-input :input="'media'" :type="'file'"></x-form.form-input>
            <x-form.form-input :input="'phone'" :type="'phone'"></x-form.form-input>
            <x-form.form-select :input="'page_id'" :description="'Select a page or leave empty'" :items="$pages" />
            <x-form.form-select :input="'gender'" :description="'Select a gender or leave empty'" :items="$genders" />
            <div class="mb-3 row">
                <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
            </div>
        </form>
    </x-form.form-header>
@endsection
