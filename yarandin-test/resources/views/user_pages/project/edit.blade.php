@extends('user_pages.layout')

@section('header')
<h2 class="font-semibold pl-4 text-xl text-gray-800 leading-tight">
    {{ __('project.edit_project') . ': "' . $project->title . '"' }}
</h2>
@endsection

@section('body')

<form id="edit-project">
    <x-project.form :project="$project" />

    <div class="flex justify-between mt-12">
        <x-button-link :href="route('dashboard')">{{ __('general.back') }}</x-button-link>
        <x-button id="submit">{{ __('general.save') }}</x-button>
    </div>
</form>

<script>
    $(document).ready(() => {
        const form = $("#edit-project");
        const submitBtn = $("#submit");

        const formErrorsHandler = FormErrorsHandler('edit-project');
    
        form.submit((e) => {
            e.preventDefault();
            submitBtn.prop('disabled', true);
            formErrorsHandler.crearAll();

            $.ajax({
                type: "PATCH",
                url: '/api/projects/{{ $project->id }}',
                headers: {"X-XSRF-TOKEN": $.cookie("XSRF-TOKEN")},
                data: form.serialize(),
                complete: (xhr) => {
                    if (xhr.status == 200) {
                        location.href = '/dashboard';
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
