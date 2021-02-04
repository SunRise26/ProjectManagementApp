@extends('user_pages.layout')

@section('header')
<h2 class="font-semibold pl-4 text-xl text-gray-800 leading-tight">
    {{ $project->title }} (id: {{ $project->id }})
</h2>
@endsection

@section('body')

<x-button-link :href="route('user.task_create', ['project_id' => $project->id])" class="justify-center" >
    {{ __('Create new task') }}
</x-button-link>

@if (count($tasks))
    <div class="default-list tasks-list">
        @foreach ($tasks as $task)
            <x-project.task :task="$task" :taskStatuses="$taskStatuses" />
        @endforeach
    </div>
@endif

@endsection
