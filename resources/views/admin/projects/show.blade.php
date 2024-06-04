@extends('layouts.admin')

@section('content')
    <div class="container py-3">
        <div class="row">
            <div class="col-7">
                @if (Str::startsWith($project->image, 'http'))
                    <img src="{{ $project->image }}" alt="{{ $project->title }}">
                @else
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                @endif
            </div>
            <div class="col-5 p-4">
                <div class="actions d-flex justify-content-end pb-4">
                    <a class="btn btn-secondary" href="{{ route('admin.projects.index') }}">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <a class="btn btn-primary mx-2" href="{{ route('admin.projects.edit', $project) }}">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <!-- Modal trigger button -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId-delete">
                        <i class="fa-solid fa-trash"></i>
                    </button>

                    <!-- Modal Body -->
                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                    <div class="modal fade" id="modalId-delete" tabindex="-1" data-bs-backdrop="static"
                        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">
                                        DELETING PROJECT
                                    </h5>
                                </div>
                                <div class="modal-body">You're deleting {{ $project->title }}, it will not be
                                    possible to bring it back</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="fa-solid fa-arrow-left"></i>
                                    </button>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            DELETE
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (session('status'))
                    <div class="bg-light my-2 p-3 border border-secondary">{{ session('status') }}</div>
                @endif
                <h2>{{ $project->title }}</h2>
                <div class="metadata"><strong>Source code:</strong> <a class="text-muted"
                        href="{{ $project->source_code_url }}">{{ $project->source_code_url }}</a>
                    <br>
                    <strong>Production site:</strong> <a class="text-muted"
                        href="{{ $project->production_site_url }}">{{ $project->production_site_url }}</a>
                    <br>
                    <strong>Type:</strong> {{ $project->type ? $project->type->name : 'None' }}
                    <br>
                    <strong>Technologies:</strong>
                    @if (count($project->technologies) == 0)
                        None
                    @else
                        @foreach ($project->technologies as $tech)
                            @if ($tech->id === last($project->technologies->toArray())['id'])
                                {{ $tech->name }}
                            @else
                                {{ $tech->name }},
                            @endif
                        @endforeach
                    @endif
                </div>
                <p>{{ $project->description }}</p>
            </div>
        </div>

    </div>
@endsection
