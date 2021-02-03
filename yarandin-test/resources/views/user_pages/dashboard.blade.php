@extends('user_pages.layout')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Dashboard') }}
</h2>
@endsection

@section('body')
@foreach ($projects as $project)
<div>
    <span class="id">{{ $project->id }}</span>
    <span class="title">{{ $project->title }}</span>
    <span class="description">{{ $project->description }}</span>
</div>
@endforeach
<x-button-link :href="route('user.project_create')">
    {{ __('Create new project') }}
</x-button-link>
@endsection
