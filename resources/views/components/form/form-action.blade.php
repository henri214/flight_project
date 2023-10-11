<td>
    <form action="{{ route($item . 's.destroy', $value) }}" method="POST">
        <button type="button" data-bs-toggle="modal" data-bs-target="#editModal"
            data-attr="{{ route($item . 's.update', $value) }}"
            {{ $attributes->merge(['class' => 'btn edit-button btn-primary']) }}>Edit</button>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</td>
