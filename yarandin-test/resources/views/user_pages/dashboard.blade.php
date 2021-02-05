@extends('user_pages.layout', ['bodyClassName' => 'dashboard'])

@section('header')
<h2 class="font-semibold pl-4 text-xl text-gray-800 leading-tight">
    {{ __('general.dashboard') }}
</h2>
@endsection

@section('body')

<x-button-link :href="route('user.project_create')" class="justify-center" >
    {{ __('project.create_new') }}
</x-button-link>

@if (count($projects))
    <div class="default-list projects-list">
        @foreach ($projects as $project)
            <x-dashboard.project :project="$project" />
        @endforeach
    </div>
@endif

@endsection
