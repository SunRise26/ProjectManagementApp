@extends('user_pages.layout')

@php
$project_id = request("project_id");
$project_url = route('user.project_details', ['id' => $project_id]);
@endphp

@section('header')
<h2 class="font-semibold pl-4 text-xl text-gray-800 leading-tight">
    {{ __('New Task') }}
</h2>
@endsection

@section('body')

<form id="create-task">
    <x-task.form />

    <div class="flex justify-between mt-12">
        <x-button-link :href="$project_url">{{ __('Back') }}</x-button-link>
        <x-button id="submit">{{ __('Save') }}</x-button>
    </div>
</form>

<script>
$(document).ready(() => {
    const form = $("#create-task");
    const submitBtn = $("#submit");

    const formErrorsHandler = FormErrorsHandler('create-task');

    form.submit((e) => {
        e.preventDefault();
        submitBtn.prop('disabled', true);

        formErrorsHandler.crearAll();

        $.ajax({
            type: "POST",
            url: '/api/tasks?project_id={{ $project_id }}',
            headers: {"X-XSRF-TOKEN": $.cookie("XSRF-TOKEN")},
            data: form.serialize() + "&project_id={{ $project_id }}",
            complete: (xhr) => {
                if (xhr.status == 201) {
                    location.href = '{{ $project_url }}';
                    return;
                } else if (xhr.status == 422) {
                    formErrorsHandler.setErrors(xhr.responseJSON.errors);
                }
                submitBtn.prop('disabled', false);
            }
        });
    });
});
</script>

@endsection
