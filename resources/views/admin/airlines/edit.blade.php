<x-form.form-header-action :item="'edit airline'">
    <form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data" id="edit-form">
        @csrf
        @method('PATCH')
        <div class="card-body">
            <x-form.form-input :input="'name'" :type="'text'" :id="'update_name'"></x-form.form-input>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info">Update</button>
        </div>
    </form>
</x-form.form-header-action>
