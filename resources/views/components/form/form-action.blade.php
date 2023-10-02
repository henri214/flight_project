<td>
    <form action="{{ route($item . 's.destroy', $value) }}" method="Post">
        <a class="btn btn-primary" href="{{ route($item . 's.edit', $value) }}">Edit</a>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</td>
