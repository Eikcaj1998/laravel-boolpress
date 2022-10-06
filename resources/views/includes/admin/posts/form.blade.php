@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if ($post->exists)
    <form action="{{ route('admin.posts.update', $post) }}" method="POST" novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.posts.store') }}" method="POST" novalidate>
@endif

@csrf
<div class="row">
    <div class="col-8">
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{ old('title', $post->title) }}" required minlength="5" maxlength="50">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label for="category_id">Categoria</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">Nessuna Categoria</option>
                @foreach ($categories as $category)
                    <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                        {{ $category->label }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="content">contenuto</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="8"
                required>{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-11">
        <div class="form-group">
            <label for="image">Immagine</label>
            <input type="url" class="form-control @error('image') is-invalid @enderror" id="image-field"
                name="image" value="{{ old('image', $post->image) }}">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-1">
        <img id="preview"
            src="{{ $post->image ?? 'https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png' }}"
            alt="post image preview" class="img-fluid">
    </div>
    <div class="col-12 d-flex justify_content-between">
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1"
                @if (old('is_published', $post->is_published)) checked @endif>
            <label class="form-check-label" for="is_published">pubblicato</label>
        </div>
    </div>
</div>
<hr>
<footer class="d-flex justify-content-between">
    <a href="{{ route('admin.posts.index') }}"class="btn btn-secondary">
        <i class="fa-solid fa-rotate-left mr-2"></i> Indietro
    </a>
    <button class="btn btn-success" id="button">
        <i class="fa-solid fa-floppy-disk mr-2"></i>
    </button>
</footer>
</form>
