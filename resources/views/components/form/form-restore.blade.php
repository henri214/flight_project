@if ($item->deleted_at !== null)
    <td>{{ $item->deleted_at }}</td>
    <td>
        <form id="restore-form" action="{{ route($name . 's.restore', $item) }}" method="POST">
            @csrf
            <button class="btn btn-success" type="submit">Restore</button>
        </form>
    </td>
@else
    <td>Has not been deleted yet</td>
    <td>---</td>
@endif
