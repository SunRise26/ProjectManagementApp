@extends('user_pages.layout')

@section('header')
<h2 class="font-semibold pl-4 text-xl text-gray-800 leading-tight">
    {{ $project->title }} (id: {{ $project->id }})
</h2>
@endsection

@section('body')
project page
@endsection
