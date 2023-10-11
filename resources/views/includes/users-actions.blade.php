<x-form.form-action
:item="$item"
:value="$value"
data-username="{{ $value->username }}"
data-email="{{ $value->email }}"
data-age="{{ $value->age }}"
data-media="{{ $value->media }}"
data-phone="{{ $value->phone }}"
data-page_id="{{ $value->page_id }}"
data-gender="{{ $value->gender }}" />