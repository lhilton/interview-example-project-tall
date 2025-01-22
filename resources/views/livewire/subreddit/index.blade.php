<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block">
        {{ __("Reddit") }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h2 class="text-3xl font-bold text-center">Add to my feed:</h2>
            <form wire:submit="save">
                <div class="my-6 flex max-w-lg mx-auto">
                    <div
                        class="flex shrink-0 items-center rounded-l-xl bg-gray-100 font-bold px-4 text-lg text-gray-700"
                    >
                        r/
                    </div>
                    <input
                        type="text"
                        wire:model="url"
                        class="-ml-px block w-full grow rounded-r-md bg-gray-50 px-3 py-3 text-xl text-gray-900 placeholder:text-gray-300 placeholder:font-bold outline-none order-transparent focus:border-transparent focus:ring-0 border-none"
                        placeholder="AskReddit"
                    />
                    <button
                        wire:loading.class="opacity-50"
                        wire:target="save"
                        type="submit"
                        class="relative flex shrink-0 items-center rounded-r-xl bg-white text-lg font-bold px-5 py-2 text-white outline-none bg-[#05a6c5]"
                    >
                        <span wire:loading.class="opacity-0" wire:target="save">
                            SUBSCRIBE
                        </span>
                        <span
                            wire:loading
                            wire:target="save"
                            class="absolute left-1/2 transform -translate-x-1/2"
                        >
                            <svg
                                class="animate-spin w-6 h-6 text-gray-800"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                />
                            </svg>
                        </span>
                    </button>
                </div>
                @error("url")
                    <p
                        class="text-center mt-3 font-medium text-lg text-red-500"
                    >
                        {{ $message }}
                    </p>
                @enderror
            </form>

            <p
                class="pb-1 text-xs text-gray-400 border-b border-b-gray-100 mb-6"
            >
                {{ $previews->count() }}/5 Channels
            </p>

            @foreach ($previews as $preview)
                <div
                    class="border-2 rounded-xl p-6 mb-6 grid grid-cols-6 gap-8 relative"
                >
                    <div class="h-full content-center">
                        @if ($preview->request_successful && $preview->thumbnail)
                            <img
                                class="rounded-full w-full items-center aspect-square"
                                src="{{ $preview->thumbnail }}"
                                alt="{{ $preview->title ?? $preview->subreddit_name }}"
                            />
                        @else
                            <div
                                class="bg-gray-100 flex items-center justify-center rounded-full text-center w-full h-full items-center"
                            >
                                <p class="text-xs text-gray-700 font-bold">
                                    No Image
                                </p>
                            </div>
                        @endif
                    </div>
                    <div class="col-span-5">
                        @if ($preview->request_successful)
                            <p class="text-sm text-gray-700 font-bold mb-2">
                                <span class="text-gray-400 font-medium">
                                    r/
                                </span>
                                {{ $preview->subreddit_name }}
                            </p>
                            <p
                                class="mb-2 text-xl font-bold underline leading-tight tracking-tight text-[#05a6c5]"
                            >
                                <a
                                    href="{{ $preview->full_permalink }}"
                                    target="_blank"
                                >
                                    {{ $preview->title }}
                                </a>
                            </p>
                            <p class="text-sm text-gray-400 font-bold">
                                {{ $preview->ups }}

                                <svg
                                    class="w-5 h-5 text-gray-500 opacity-75 inline-block -mt-1.5"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z"
                                        clip-rule="evenodd"
                                    />
                                </svg>

                                <span class="inline-block mx-3">|</span>

                                {{ $preview->created_at->format("M j, Y h:m A") }}
                            </p>
                        @else
                            <p class="text-lg font-medium text-red-500">
                                Could not load top post from:
                                {{ $preview->subreddit->url }}
                            </p>
                        @endif
                    </div>

                    <svg
                        class="w-6 h-6 text-[#05a6c5] absolute top-2 right-2 cursor-pointer"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="none"
                        viewBox="0 0 24 24"
                        wire:click="remove({{ $preview->subreddit }})"
                        wire:confirm="Are you sure you want to unsubscribe from this subreddit?"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6"
                        />
                    </svg>
                </div>
            @endforeach
        </div>
    </div>
</div>
