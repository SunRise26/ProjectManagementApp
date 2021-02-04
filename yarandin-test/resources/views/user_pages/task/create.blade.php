@extends('user_pages.layout')

@php
$projectId = $project->id;
$project_url = route('user.project_details', ['id' => $projectId]);
$create_task_url = route('api.tasks.store');
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

        const formData = new FormData(e.target);

        // set project id
        formData.append('project_id', {{ $projectId }});

        // set attached file
        const files = $("#attached_file")[0].files;
        if (files.length > 0) {
            formData.append('attached_file', files[0]);
        }

        $.ajax({
            type: "POST",
            url: '{{ $create_task_url }}',
            headers: {"X-XSRF-TOKEN": $.cookie("XSRF-TOKEN")},
            data: formData,
            processData: false,
            contentType: false,
            complete: (xhr) => {
                if (xhr.status == 201) {
                    location.href = '{{ $project_url }}';
                    return;
                } else if (xhr.status == 422) {
                    formErrorsHandler.setErrors(xhr.responseJSON.errors);
                } else if (xhr.status == 413) {
                    formErrorsHandler.setErrors({
                        "attached_file": ["server error (413): file too large"],
                    });
                }
                submitBtn.prop('disabled', false);
            }
        });
    });
});
</script>

@endsection
