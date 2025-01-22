<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block">
        {{ __("Reddit") }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <form wire:submit="save">
                <input wire:model="url" type="text" />
                <button type="submit">Save</button>
                @error("url")
                    <p>{{ $message }}</p>
                @enderror
            </form>

            <ul class="mt-4">
                @foreach ($subreddits as $subreddit)
                    <li>
                        {{ $subreddit->url }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
