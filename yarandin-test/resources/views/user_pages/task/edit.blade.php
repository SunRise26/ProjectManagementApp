@extends('user_pages.layout')

@php
    $project_url = route('user.project_details', ['id' => $task->project_id]);
@endphp

@section('header')
<h2 class="font-semibold pl-4 text-xl text-gray-800 leading-tight">
    {{ __('Edit task') . ': "' . $task->title . '"' }}
</h2>
@endsection

@section('body')

<form id="edit-task">
    <x-task.form :task="$task" :taskStatuses="$taskStatuses" />

    <div class="flex justify-between mt-12">
        <x-button-link :href="$project_url">{{ __('Back') }}</x-button-link>
        <x-button id="submit">{{ __('Save') }}</x-button>
    </div>
</form>

<script>
    $(document).ready(() => {
        const form = $("#edit-task");
        const submitBtn = $("#submit");

        const formErrorsHandler = FormErrorsHandler('edit-task');
    
        form.submit((e) => {
            e.preventDefault();
            submitBtn.prop('disabled', true);
            formErrorsHandler.crearAll();

            $.ajax({
                type: "PATCH",
                url: '/api/tasks/{{ $task->id }}',
                headers: {"X-XSRF-TOKEN": $.cookie("XSRF-TOKEN")},
                data: form.serialize(),
                complete: (xhr) => {
                    if (xhr.status == 200) {
                        location.href = '{{ $project_url }}';
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
