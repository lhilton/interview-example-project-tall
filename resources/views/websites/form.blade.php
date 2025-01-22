<form wire:submit="save">
    <div class="mb-4">
        <label for="name" class="block text-base font-bold text-gray-900">
            Name
        </label>
        <div class="mt-2 grid grid-cols-1">
            <input
                type="text"
                id="name"
                wire:model="name"
                class="col-start-1 row-start-1 block w-full rounded-md bg-white py-1.5 pl-3 pr-10 text-base @error("name") text-red-900 outline outline-1 -outline-offset-1 outline-red-300 placeholder:text-red-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 @enderror sm:pr-9 sm:text-sm/6"
                placeholder="Home | Foo Bar"
            />
            @error("name")
                <svg
                    class="pointer-events-none col-start-1 row-start-1 mr-3 size-5 self-center justify-self-end text-red-500 sm:size-4"
                    viewBox="0 0 16 16"
                    fill="currentColor"
                    aria-hidden="true"
                    data-slot="icon"
                >
                    <path
                        fill-rule="evenodd"
                        d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14ZM8 4a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-1.5 0v-3A.75.75 0 0 1 8 4Zm0 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                        clip-rule="evenodd"
                    />
                </svg>
            @enderror
        </div>
        @error("name")
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="url" class="block text-base font-bold text-gray-900">
            URL
        </label>
        <div class="mt-2 grid grid-cols-1">
            <input
                type="text"
                id="url"
                wire:model="url"
                class="col-start-1 row-start-1 block w-full rounded-md bg-white py-1.5 pl-3 pr-10 text-base @error("url") text-red-900 outline outline-1 -outline-offset-1 outline-red-300 placeholder:text-red-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 @enderror sm:pr-9 sm:text-sm/6"
                placeholder="https://foo.bar"
            />
            @error("name")
                <svg
                    class="pointer-events-none col-start-1 row-start-1 mr-3 size-5 self-center justify-self-end text-red-500 sm:size-4"
                    viewBox="0 0 16 16"
                    fill="currentColor"
                    aria-hidden="true"
                    data-slot="icon"
                >
                    <path
                        fill-rule="evenodd"
                        d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14ZM8 4a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-1.5 0v-3A.75.75 0 0 1 8 4Zm0 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                        clip-rule="evenodd"
                    />
                </svg>
            @enderror
        </div>
        @error("url")
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="mb-4">
        <label
            for="description"
            class="block text-base font-bold text-gray-900"
        >
            Description
        </label>
        <div class="mt-2 grid grid-cols-1">
            <textarea
                id="description"
                wire:model="description"
                rows="4"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            ></textarea>

            @error("description")
                <svg
                    class="pointer-events-none col-start-1 row-start-1 mr-3 size-5 self-center justify-self-end text-red-500 sm:size-4"
                    viewBox="0 0 16 16"
                    fill="currentColor"
                    aria-hidden="true"
                    data-slot="icon"
                >
                    <path
                        fill-rule="evenodd"
                        d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14ZM8 4a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-1.5 0v-3A.75.75 0 0 1 8 4Zm0 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                        clip-rule="evenodd"
                    />
                </svg>
            @enderror
        </div>
        @error("description")
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

        <div>
            <label
                for="description"
                class="mt-4 mb-2 block text-base font-bold text-gray-900"
            >
                Tags
            </label>
            @foreach ($tags as $tag)
                <div class="flex gap-3">
                    <div class="flex h-6 shrink-0 items-center">
                        <div class="group grid size-4 grid-cols-1">
                            <input
                                id="tag-{{ $tag->id }}"
                                type="checkbox"
                                wire:model="websiteTags"
                                value="{{ $tag->id }}"
                                class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                            />
                            <svg
                                class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25"
                                viewBox="0 0 14 14"
                                fill="none"
                            >
                                <path
                                    class="opacity-0 group-has-[:checked]:opacity-100"
                                    d="M3 8L6 11L11 3.5"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    class="opacity-0 group-has-[:indeterminate]:opacity-100"
                                    d="M3 7H11"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </div>
                    </div>
                    <div class="text-sm/6">
                        <label
                            for="tag-{{ $tag->id }}"
                            class="font-medium text-gray-900"
                        >
                            {{ $tag->name }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="grid grid-cols-2 w-full gap-4">
        <div class="text-left">
            <button
                wire:click="cancel"
                type="button"
                class="rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500"
            >
                Cancel
            </button>
        </div>
        <div class="text-right">
            <button
                type="submit"
                class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500"
            >
                Save
            </button>
        </div>
    </div>
</form>
