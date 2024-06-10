@extends('layouts.app')
@section('content')
<div class="container-sm">
    <div class="mb-2 mt-2">Filter by:</div>
    <form class="" action="{{ route('welcome') }}" method="GET">
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
                <a href="{{ route('welcome') }}" class="btn btn-secondary">Reset</a>
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
Users
@foreach($users as $user)
<p>{{$user->name}}</p>
@endforeach

@endsection