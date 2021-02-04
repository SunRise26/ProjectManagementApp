@php
$id = $project->id;
$project_block_id = 'project-block-' . $id;
$delete_button_id = 'delete-project-' . $id;
@endphp

<div class="block" id="{{ $project_block_id }}">
    <div class="list-row">
        <div class="title-data">
            <span class="id">(id: {{ $id }})</span>
            <span class="title">{{ $project->title }}</span>
        </div>
        <div class="actions">
            <x-button-link :href="route('user.project_details', ['id' => $id])">go to project</x-button-link>
            <x-button-link :href="route('user.project_edit', ['id' => $id])">edit</x-button-link>
            <x-button id="{{ $delete_button_id }}">delete</x-button-link>
        </div>
    </div>
    @if (!empty($project->description))
        <div class="list-row description--outer">
            <span class="description">{{ $project->description }}</span>
        </div>
    @endif

</div>

<script type="text/javascript">
$(document).ready(() => {
    const projectBlock = $("#{{ $project_block_id }}")
    const deleteBtn = $("#{{ $delete_button_id }}");

    const setActionsDisabled = (disabled) => {
        const buttons = projectBlock.find(".button");
        disabled ? buttons.addClass('is-disabled') : buttons.removeClass('is-disabled');
    }

    deleteBtn.click((e) => {
        setActionsDisabled(true);

        $.ajax({
            type: "DELETE",
            url: '/api/projects/{{ $id }}',
            headers: {"X-XSRF-TOKEN": $.cookie("XSRF-TOKEN")},
            complete: (xhr) => {
                if (xhr.status == 200) {
                    projectBlock.remove();
                } else {
                    setActionsDisabled(false);
                }
            }
        });
    });
});
</script>