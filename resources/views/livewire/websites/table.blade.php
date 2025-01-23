<div class="px-4 sm:px-6 lg:px-8 py-4" x-data="{ createOpen: false }">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold text-gray-900">Websites</h1>
            <p class="mt-2 text-sm text-gray-700">
                A list of websites you have bookmarked.
            </p>
        </div>
        <div class="sm:flex-auto">
            <div>
                <label
                    for="location"
                    class="inline text-sm/6 font-medium text-gray-900"
                >
                    Page Size:&nbsp;&nbsp;
                </label>

                <select
                    id="foo"
                    wire:model.change="pagination"
                    class="appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                >
                    <option>2</option>
                    <option>5</option>
                    <option>10</option>
                    <option>25</option>
                </select>
            </div>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <livewire:websites.create-modal />
        </div>
    </div>
    <div class="my-4 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th
                                scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8"
                            >
                                Name
                            </th>
                            <th
                                scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                            >
                                Url
                            </th>
                            <th
                                scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                            >
                                Updated At
                            </th>
                            <th
                                scope="col"
                                class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8"
                            >
                                <span class="sr-only">Link</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @if (! $websites || $websites->count() < 1)
                            <tr>
                                <td
                                    colspan="4"
                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-xl font-medium text-gray-900 sm:pl-6 lg:pl-8"
                                >
                                    No websites bookmarked. Please add a
                                    website.
                                </td>
                            </tr>
                        @endif

                        @foreach ($websites as $website)
                            <tr>
                                <td
                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8"
                                >
                                    {{ $website->name }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{ $website->url }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{ $website->updated_at }}
                                </td>
                                <td
                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 lg:pr-8"
                                >
                                    <a
                                        href="{{ route("website.view", ["website" => $website->id]) }}"
                                        class="text-indigo-600 hover:text-indigo-900"
                                    >
                                        Edit
                                        <span class="sr-only">
                                            {{ $website->name }}
                                        </span>
                                    </a>
                                    &nbsp;|&nbsp;
                                    <a
                                        href="{{ $website->url }}"
                                        class="text-indigo-600 hover:text-indigo-900"
                                        target="_blank"
                                    >
                                        Visit
                                        <span class="sr-only">
                                            {{ $website->name }}
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $websites->links() }}
</div>
