@extends('layouts.app')
@section('content')
<div class="container mb-3">
    <h1>{{$project->title}}</h1>
    <p>{{$project->description}}</p>
    <p>
        <span>Type:</span> {{($project->type)->name ?? 'no type' }}
    </p>
    <a class="btn btn-secondary" href="{{route('admin.projects.index')}}">Back to projects</a>
    <a class="btn btn-secondary" href="{{route('admin.projects.edit', $project)}}">Edit</a>
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$project->id}}">
        Delete
    </button>

    <div class="modal fade" id="exampleModal{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$project->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel{{$project->id}}">Attention</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Do you really want delete?</strong> {{$project->title}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                    <form class="delete-character" action="{{ route('admin.projects.destroy',$project) }}" method="POST">


                        @method('DELETE')
                        @csrf

                        <button class="btn btn-danger">Delete</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection