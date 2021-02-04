@extends('user_pages.layout', ['bodyClassName' => 'dashboard'])

@section('header')
<h2 class="font-semibold pl-4 text-xl text-gray-800 leading-tight">
    {{ __('Dashboard') }}
</h2>
@endsection

@section('body')

<x-button-link :href="route('user.project_create')" class="justify-center" >
    {{ __('Create new project') }}
</x-button-link>

@if (count($projects))
    <div class="projects-list">
        @foreach ($projects as $project)
            <x-dashboard.project :project="$project" />
        @endforeach
    </div>
@endif

@endsection
