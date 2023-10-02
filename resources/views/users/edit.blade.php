@extends('layouts.app')

@section('content')
    <x-form.form-header :item="'edit user'">
        <form class="form-horizontal" action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.form-input :input="'username'" :type="'text'"></x-form.form-input>
            <x-form.form-input :input="'email'" :type="'email'"></x-form.form-input>
            <x-form.form-input :input="'age'" :type="'number'"></x-form.form-input>
            <x-form.form-input :input="'phone'" :type="'phone'"></x-form.form-input>
            <div class="mb-3 row">
                <label for="gender" class="col-md-4 col-form-label text-md-end text-start">Gender</label>
                <div class="col-md-6">
                    <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                        <option value="">Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    @if ($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
            </div>
        </form>
    </x-form.form-header>
@endsection
