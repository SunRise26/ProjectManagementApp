@php
$title = isset($project) ? $project->title : "";
$description = isset($project) ? $project->description : "";
$position = isset($project) ? $project->position : 0;
@endphp

<div class="mt-4">
    <x-label for="title" :value="__('Title')" />
    <x-input id="title" class="input block mt-1 w-full"
        type="text"
        name="title"
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
