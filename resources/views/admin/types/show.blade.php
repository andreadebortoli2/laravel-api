@extends('layouts.admin')

@section('content')
    <div class="container py-3">
        <div class="table-responsive">
            <table class="table table-success">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Project title</th>
                        <th scope="col">Go to</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr class="">
                            <td>{{ $project->id }}</td>
                            @if (Str::startsWith($project->image, 'http'))
                                <td>
                                    <img width="100" src="{{ $project->image }}" alt="{{ $project->title }}">
                                </td>
                            @else
                                <td>
                                    <img width="100" src="{{ asset('storage/' . $project->image) }}"
                                        alt="{{ $project->title }}">
                                </td>
                            @endif
                            <td>{{ $project->title }}</td>
                            <td>
                                <a class="btn btn-secondary" href="{{ route('admin.projects.show', $project) }}">
                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                </a>
                            </td>
                    @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
