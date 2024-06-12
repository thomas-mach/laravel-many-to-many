@extends('layouts.app')
@section('content')
<h1>My Projects</h1>

@foreach($projects as $project)
<p>{{$project->title}}</p>
@endforeach

@endsection