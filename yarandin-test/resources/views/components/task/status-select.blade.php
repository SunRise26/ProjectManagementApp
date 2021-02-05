<x-select {{ $attributes->merge(['class' => 'cursor-pointer']) }}>
    @foreach ($taskStatuses as $taskStatus)
        <option {{ $taskStatus->id == $selectedId ? "selected" : "" }} value="{{ $taskStatus->id }}">
            {{ $taskStatus->getTranslatedTitle() }}
        </option>
    @endforeach
</x-select>
