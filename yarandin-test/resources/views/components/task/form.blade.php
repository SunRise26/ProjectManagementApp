@php
$title = isset($task) ? $task->title : "";
$description = isset($task) ? $task->description : "";
$position = isset($task) ? $task->position : 0;
@endphp

<div class="mt-4">
    <x-label for="title" :value="__('Title')" />
    <x-input id="title" class="input block mt-1 w-full"
        type="text"
        name="title"
        autocomplete="off"
        value="{{ $title }}"
    />
</div>

<div class="mt-4">
    <x-label for="description" :value="__('Description')" />
    <x-textarea id="description" class="input block mt-1 w-full"
        name="description"
    >{{ $description }}</x-textarea>
</div>

<div class="mt-4">
    <x-label for="position" :value="__('Position')" />
    <x-input id="position" class="input block mt-1 w-full"
        type="number"
        name="position"
        min="0"
        max="10000"
        value="{{ $position }}"
    />
</div>

@if (!empty($task))
    <div class="mt-4">
        <x-label for="status_id" :value="__('Status')" />
        <x-task.status-select
            id="status_id"
            name="status_id"
            class="w-full"
            :taskStatuses="$taskStatuses"
            :selectedId="$task->status_id" />
    </div>
@else
    <div class="mt-4">
        <x-label for="attached_file" :value="__('Attached File')" />
        <x-input type="file" name="attached_file" id="attached_file" />
    </div>
@endif
