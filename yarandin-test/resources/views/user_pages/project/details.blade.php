@extends('user_pages.layout')

@section('header')
<h2 class="font-semibold pl-4 text-xl text-gray-800 leading-tight">
    {{ $project->title }} (id: {{ $project->id }})
</h2>
@endsection

@section('body')

<form method="GET" id="status-filter-form" class="flex justify-around mb-12">
@csrf

@foreach ($taskStatuses as $taskStatus)
    <div class="flex items-center">
        @php
            $checked = in_array($taskStatus->id, $selectedTaskStatuses);
        @endphp
        <x-input type="checkbox"
            name="tasks_status_ids[]"
            id="{{ $taskStatus->code }}"
            value="{{ $taskStatus->id }}"
            class="status-filter-checkbox cursor-pointer"
            :checked="$checked" />
        <label for="{{ $taskStatus->code }}"
            class="cursor-pointer pl-4">
            {{ $taskStatus->getTranslatedTitle() }}
        </label>
    </div>
@endforeach
</form>

<x-button-link :href="route('user.task_create', ['project_id' => $project->id])" class="justify-center" >
    {{ __('task.create_new') }}
</x-button-link>

@if (count($tasks))
    <div class="default-list tasks-list">
        @foreach ($tasks as $task)
            <x-project.task :task="$task" :taskStatuses="$taskStatuses" />
        @endforeach
    </div>
@endif

<script type="text/javascript">
$(document).ready(() => {
    const statusFilterForm = $("#status-filter-form");
    const statusFilterCheckboxes = $(".status-filter-checkbox");

    statusFilterCheckboxes.on('click', () => {
        statusFilterForm.submit();
    });
});
</script>

@endsection
