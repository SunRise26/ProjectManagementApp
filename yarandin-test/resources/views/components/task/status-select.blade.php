<x-select {{ $attributes->merge(['class' => 'cursor-pointer']) }}>
    @foreach ($taskStatuses as $taskStatus)
        <option {{ $taskStatus->id == $selectedId ? "selected" : "" }} value="{{ $taskStatus->id }}">
            {{ __("task_status.$taskStatus->code") }}
        </option>
    @endforeach
</x-select>
