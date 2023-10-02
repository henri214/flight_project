<div class="mb-3 row">
    <label for="{{ $input }}"
        class="col-md-4 col-form-label text-md-end text-start">{{ ucwords(Str::replace('_', ' ', $input)) }}</label>
    <div class="col-md-6">
        <select name="{{ $input }}" id="{{ $input }}"
            class="form-control @error($input) is-invalid @enderror">
            <option value="">{{ $description }}</option>
            @foreach ($items as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        @if ($errors->has($input))
            <span class="text-danger">{{ $errors->first($input) }}</span>
        @endif
    </div>
</div>
