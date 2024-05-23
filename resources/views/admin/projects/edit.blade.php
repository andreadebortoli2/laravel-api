@extends('layouts.admin')

@section('content')
    @if ($errors->all())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container py-3">
        <form action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    aria-describedby="helpIdTitle" placeholder="Title" value="{{ old('title', $project->title) }}" />
                <small id="helpIdTitle" class="form-text text-muted">Write the project title</small>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Author</label>
                <input type="text" class="form-control @error('author') is-invalid @enderror" name="author"
                    id="author" aria-describedby="helpIdAuthor" placeholder="Name"
                    value="{{ old('author', $project->author) }}" />
                <small id="helpIdAuthor" class="form-text text-muted">Write the name of the author</small>
                @error('author')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select form-select-lg" name="type_id" id="type_id">
                    <option selected disabled>Select type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}"
                            {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>{{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Source code url</label>
                <input type="text" class="form-control @error('source_code_url') is-invalid @enderror"
                    name="source_code_url" id="source_code_url" aria-describedby="helpIdSource_code_url"
                    placeholder="Https://" value="{{ old('source_code_url', $project->source_code_url) }}" />
                <small id="helpIdSource_code_url" class="form-text text-muted">Insert the source code url</small>
                @error('source_code_url')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Production site url</label>
                <input type="text" class="form-control @error('production_site_url') is-invalid @enderror"
                    name="production_site_url" id="production_site_url" aria-describedby="helpIdProduction_site_url"
                    placeholder="Https://" value="{{ old('production_site_url', $project->production_site_url) }}" />
                <small id="helpIdProduction_site_url" class="form-text text-muted">Insert the production site url</small>
                @error('production_site_url')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                    id="image" aria-describedby="helpIdImage" />
                <small id="helpIdImage" class="form-text text-muted">Insert the project image</small>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="6" placeholder="Write the description of the project">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <a class="btn btn-secondary" href="{{ url()->previous() }}">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <button type="submit" class="btn btn-primary">
                Edit
            </button>


        </form>
    </div>
@endsection
