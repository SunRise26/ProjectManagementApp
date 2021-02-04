@php
$id = $task->id;
$task_block_id = 'task-block-' . $id;
$delete_button_id = 'delete-task-' . $id;
$status_selector_id = 'status-selector-' . $id;
@endphp

<div class="block" id="{{ $task_block_id }}">
    <div class="list-row">
        <div class="title-data">
            <span class="id">(id: {{ $id }})</span>
            <span class="title">{{ $task->title }}</span>
        </div>
        <div class="actions">
            <x-task.status-select id="{{ $status_selector_id }}" class="button" :taskStatuses="$taskStatuses" :selectedId="$task->status_id" />
            <x-button-link :href="route('user.task_edit', ['id' => $id])">edit</x-button-link>
            <x-button id="{{ $delete_button_id }}">delete</x-button-link>
        </div>
    </div>
    @if (!empty($task->description))
        <div class="list-row description--outer">
            <span class="description">{{ $task->description }}</span>
        </div>
    @endif

</div>


<script type="text/javascript">
    $(document).ready(() => {
        const taskBlock = $("#{{ $task_block_id }}")
        const deleteBtn = $("#{{ $delete_button_id }}");
        const statusSelector = $("#{{ $status_selector_id }}");
    
        const setActionsDisabled = (disabled) => {
            const buttons = taskBlock.find(".button");
            disabled ? buttons.addClass('is-disabled') : buttons.removeClass('is-disabled');
        }
    
        deleteBtn.click((e) => {
            setActionsDisabled(true);
    
            $.ajax({
                type: "DELETE",
                url: '/api/tasks/{{ $id }}',
                headers: {"X-XSRF-TOKEN": $.cookie("XSRF-TOKEN")},
                complete: (xhr) => {
                    if (xhr.status == 200) {
                        taskBlock.remove();
                    } else {
                        setActionsDisabled(false);
                    }
                }
            });
        });

        statusSelector.change((e) => {
            const target = $(e.target);
            setActionsDisabled(true);

            $.ajax({
                type: "PATCH",
                url: '/api/tasks/{{ $id }}',
                headers: {"X-XSRF-TOKEN": $.cookie("XSRF-TOKEN")},
                data: {
                    status_id: target.val()
                },
                complete: (xhr) => {
                    if (xhr.status != 200) {
                        location.href = window.location.href;
                    }
                    setActionsDisabled(false);
                }
            });
        });
    });
</script>