<td>
    <form id="restore-form" action="{{ route($item . 's.restore', $value) }}" method="POST">
        @csrf
        <button class="btn btn-success" type="submit">Restore</button>
    </form>
</td>
