<x-form.form-header-action :item="'edit flight'">
    <form class="form-horizontal" action="#" method="POST" id="edit-form" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="card-body">
            <x-form.form-input :input="'name'" :id="'update-name'" :type="'text'"></x-form.form-input>
            <x-form.form-input :input="'country_to'" :id="'country_to'" :type="'text'"></x-form.form-input>
            <x-form.form-input :input="'departure_time'" :id="'departure_time'" :type="'datetime-local'"></x-form.form-input>
            <x-form.form-input :input="'arrival_time'" :id="'arrival_time'" :type="'datetime-local'"></x-form.form-input>
            <x-form.form-select :input="'airline_id'" :id="'airline_id'" :description="'Select Airline'" :items="$airlines" />
            <x-form.form-input :input="'price'" :id="'price'" :type="'number'" min="10"
                max="2000"></x-form.form-input>
            <x-form.form-input :input="'pasangers'" :id="'pasangers'" :type="'number'" min="100"
                max="200"></x-form.form-input>
            <x-form.form-select :input="'is_available'" :description="'Select if the flight is one way or not :'" :items="$availability" />

            <x-form.form-select :input="'two_way'" :description="'Select if there are available places in this flight :'" :items="$twoWay" />
            <div id="show" style="display: none">
                <x-form.form-input :input="'two_way_departure_time'" :id="'two_way_departure_time'" :type="'datetime-local'"></x-form.form-input>
                <x-form.form-input :input="'two_way_arrival_time'" :id="'two_way_arrival_time'" :type="'datetime-local'"></x-form.form-input>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info">Update</button>
        </div>
    </form>

</x-form.form-header-action>

