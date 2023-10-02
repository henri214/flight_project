<div class="mb-3 row">
    <label for="{{ $input }}"
        class="col-md-4 col-form-label text-md-end text-start">{{ ucwords(Str::replace('_', ' ', $input)) }}</label>
    <div class="col-md-6">
        <input type="{{ $type }}" class="form-control @error('{{ $input }}') is-invalid @enderror"
            min="{{ $min }}" max="{{ $max }}" id="{{ $input }}" name="{{ $input }}"
            value="{{ old($input) }}">
        @if ($errors->has($input))
            <span class="text-danger">{{ $errors->first($input) }}</span>
        @endif
    </div>
</div>
