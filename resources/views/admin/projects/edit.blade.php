@extends('layouts.app')
@section('content')
<div class="container mt-3">
    <h3>Edit Project</h3>
</div>
<div class="container">
    <form class="mb-3" action="{{ route('admin.projects.update', $project) }}" method="POST">
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

        <div class="form-group">
            <div>Select technology</div>

            <!-- {{-- @dump(old('tags',[])) --}}
          {{-- collection di istanze di tipo Tag --}}
          {{-- @dump($post->tags) --}}
          {{-- collection di interi (id) --}}
          {{-- @dump($post->tags->pluck('id')) --}}
          {{-- arry di interi (id) --}}
          {{-- @dump($post->tags->pluck('id')->all()) --}} -->
            <div class="d-flex gap-2 mb-2">
                @foreach ($technologies as $technology)

                <div class="form-check">
                    <input @checked( in_array($technology->id, old('technologies',$project->technologies->pluck('id')->all() )) ) name="technologies[]" class="form-check-input" type="checkbox" value="{{ $technology->id }}" id="tag-{{$technology->id}}">
                    <label class="form-check-label" for="technology-{{$technology->id}}">
                        {{ $technology->name }}
                    </label>
                </div>
                @endforeach
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