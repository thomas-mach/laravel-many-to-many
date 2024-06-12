@extends('layouts.app')
@section('content')
<div class="container-sm">
    <div class="mb-2 mt-2">Filter by:</div>
    <form class="" action="{{ route('admin.projects.index') }}" method="GET">
        <div class="row">
            <div class="col-md-6">
                <select class="form-control" name="type_id" id="type_id" style="width: auto;">
                    <option value="" disabled {{ $typeId ? '' : 'selected' }}>Categories</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $typeId == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary">Apply Filter</button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Reset</a>
                <a href="{{ route('admin.user_projects')}}" class="btn btn-secondary">My Projects</a>
            </div>
        </div>
    </form>
</div>

<div class="container-fluid mt-3 my-auto mx-auto">
    <table class="container-sm ">
        <thead>
            <tr class="">
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


                                        @method(' DELETE') @csrf <button class="btn btn-danger">Delete</button>
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