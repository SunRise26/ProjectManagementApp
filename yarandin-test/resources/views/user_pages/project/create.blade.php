@extends('user_pages.layout')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('New Project') }}
</h2>
@endsection

@section('body')
<form id="create-project">
    <div class="mt-4">
        <x-label for="title" :value="__('Title')" />
        <x-input id="title" class="block mt-1 w-full"
            type="text"
            name="title"
        />
    </div>
    <div class="mt-4">
        <x-label for="description" :value="__('Description')" />
        <x-textarea id="description" class="block mt-1 w-full"
            name="description"
        />
    </div>
    <div class="mt-4">
        <x-label for="position" :value="__('Position')" />
        <x-input id="position" class="block mt-1 w-full"
            type="number"
            name="position"
            placeholder="0"
        />
    </div>

    <div class="flex justify-end mt-4">
        <x-button>
            {{ __('Save') }}
        </x-button>
    </div>
</form>

<script>
$(document).ready(() => {
    const form = $("#create-project");

    form.submit((e) => {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/api/projects',
            headers: {"X-XSRF-TOKEN": $.cookie("XSRF-TOKEN")},
            data: form.serialize(),
            complete: (xhr) => {
                if (xhr.status == 201) {
                    location.href = '/dashboard';
                }
            }
        });
    });
});
</script>
@endsection
