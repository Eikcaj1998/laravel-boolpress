@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if ($category->exists)
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.categories.store') }}" method="POST" novalidate>
@endif

@csrf
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="color">Label</label>
            <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label"
                value="{{ old('label', $category->label) }}" required minlength="5" maxlength="50">
            @error('label')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="color">Color</label>
            <select class="form-control @error('color') is-invalid @enderror" id="color">
                @foreach (config('colors') as $color)
                    
                <option @if (old('color',$category->color) === $color['value'])selected @endif value="{{$color['value']}}">
                    {{$color['name']}}
                </option>
                @endforeach
            </select>
            @error('color')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
<hr>
<footer class="d-flex justify-content-between">
    <a href="{{ route('admin.categories.index') }}"class="btn btn-secondary">
        <i class="fa-solid fa-rotate-left mr-2"></i> Indietro
    </a>
    <button class="btn btn-success" id="button">
        <i class="fa-solid fa-floppy-disk mr-2"></i>
    </button>
</footer>
</form>
