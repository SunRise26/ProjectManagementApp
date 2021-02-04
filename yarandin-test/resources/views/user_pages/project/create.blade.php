@extends('user_pages.layout')

@section('header')
<h2 class="font-semibold pl-4 text-xl text-gray-800 leading-tight">
    {{ __('New Project') }}
</h2>
@endsection

@section('body')
<form id="create-project">
    <x-project.form />

    <div class="flex justify-between mt-4">
        <x-button-link :href="route('dashboard')">{{ __('Back') }}</x-button-link>
        <x-button id="submit">{{ __('Save') }}</x-button>
    </div>
</form>

<script>
$(document).ready(() => {
    const form = $("#create-project");
    const submitBtn = $("#submit");

    const formErrorsHandler = FormErrorsHandler('create-project');

    form.submit((e) => {
        e.preventDefault();
        submitBtn.prop('disabled', true);

        formErrorsHandler.crearAll();

        $.ajax({
            type: "POST",
            url: '/api/projects',
            headers: {"X-XSRF-TOKEN": $.cookie("XSRF-TOKEN")},
            data: form.serialize(),
            complete: (xhr) => {
                if (xhr.status == 201) {
                    location.href = '/dashboard';
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
