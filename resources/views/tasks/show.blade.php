@extends('template')

@section('title'){{ $task->name }}, {{ $project->name }} @endsection

@section('content')
    <h2>
        {!! link_to_route('projects.show', $project->name, [$project->slug]) !!} -
        {{ $task->name }}
    </h2>
    <h4>{{ $task->user->name }} ({{ $task->user->email }})</h4>

    {{ $task->description }}
@endsection