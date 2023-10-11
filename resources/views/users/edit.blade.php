<x-form.form-header-action :item="'edit airline'">
    <form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data" id="edit-form">
        @csrf
        @method('PATCH')
        <x-form.form-input :input="'username'" :id="'username'" :type="'text'"></x-form.form-input>
        <x-form.form-input :input="'email'" :id="'email'" :type="'email'"></x-form.form-input>
        <x-form.form-input :input="'birthday'" :id="'age'" :type="'date'"></x-form.form-input>
        <x-form.form-input :input="'media'" :id="'media'" :type="'file'"></x-form.form-input>
        <x-form.form-input :input="'phone'" :id="'phone'" :type="'phone'"></x-form.form-input>
        <x-form.form-select :input="'page_id'" :id="'page_id'" :description="'Select a page or leave empty'" :items="$pages" />
        <x-form.form-select :input="'gender'" :id="'gender'" :description="'Select a gender or leave empty'" :items="$genders" />
        <div class="mb-3 row">
            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
        </div>
    </form>
</x-form.form-header-action>
