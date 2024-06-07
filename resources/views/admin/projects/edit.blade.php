@extends('layouts.app')
@section('content')
<div class="container mt-3">
    <h3>Edit Project</h3>
</div>
<div class="container">
    <form action="{{ route('admin.projects.update', $project) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{old('title', $project)}}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="10">{{old('description', $project)}}</textarea>
        </div>
        <div class="mb-3">
            <label for="type_id" class="form-label">Type</label>
            <select class="form-control" name="type_id" id="type_id">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                <option @selected( $category->id == old('type_id', $project->type_id) ) value="{{ $category->id }}"> {{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug articolo" value="{{ old('slug',$project->slug) }}">
        </div>

        <button class="btn btn-primary">Save</button>
        <a class="btn btn-secondary" href="{{route('admin.projects.index')}}">Back to projects</a>
    </form>


    @if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @endsection