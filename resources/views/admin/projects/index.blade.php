@extends('layouts.app')
@section('content')
<div class="container-fluid d-flex justify-content-center mt-3">
    <table class="">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Type</th>
                <th>Slag</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr class="">
                <td>{{$project->id}}</td>
                <td class="px-2"><a href="{{route('admin.projects.show', $project)}}">{{$project->title}}</a></td>
                <td class="px-2">{{($project->type)->name ?? 'no type' }}</td>
                <td class="px-2">{{$project->slug}}</td>
                <td>
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
                                    <p><strong>Do you really want delete?</strong>{{$project->title}}?</p>
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
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection