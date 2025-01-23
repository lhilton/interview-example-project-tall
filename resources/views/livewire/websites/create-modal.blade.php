<div>
    <x-dialog-modal wire:model="isOpen">
        <x-slot name="title">Add a website</x-slot>
        <x-slot name="content">
            @include("websites.form")
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>
    <button
        wire:click="open"
        type="button"
        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
    >
        Add website
    </button>
</div>
