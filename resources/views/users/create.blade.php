@props(['roles', 'pages', 'genders'])
    <x-form.form-header :item="'create user'">
        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <x-form.form-input :input="'username'" :type="'text'"></x-form.form-input>
            <x-form.form-input :input="'email'" :type="'email'"></x-form.form-input>
            <x-form.form-input :input="'media'" :type="'file'"></x-form.form-input>
            <x-form.form-select :input="'role_id'" :description="'Select a role or leave empty'" :items="$roles" />
            <x-form.form-select :input="'page_id'" :description="'Select a page or leave empty'" :items="$pages" />
            <x-form.form-select :input="'gender'" :description="'Select a gender or leave empty'" :items="$genders" />

            <x-form.form-input :input="'birthday'" :type="'date'"></x-form.form-input>
            <x-form.form-input :input="'phone'" :type="'phone'"></x-form.form-input>
            <x-form.form-input :input="'password'" :type="'password'"></x-form.form-input>
            <x-form.form-input :input="'password_confirmation'" :type="'password'"></x-form.form-input>
            <div class="mb-3 row">
                <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Create">
            </div>
        </form>
    </x-form.form-header>
