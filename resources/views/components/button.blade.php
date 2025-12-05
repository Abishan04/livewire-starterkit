<div>
    {{-- Use the Flux UI button component --}}
    <flux:button
        wire:click="edit({{ $rowId }})"
        intent="primary" {{-- Apply Flux UI styling options like 'primary' --}}
        size="sm"
        class="cursor-pointer"
    >
        Edit
    </flux:button>
</div>
