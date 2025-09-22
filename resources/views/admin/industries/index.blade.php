<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between gap-2 items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Industry List") }}
            </h2>
            <a
                href="{{ route('dashboard.industries.create') }}"
                class="px-4 py-1 border rounded-lg cursor-pointer border-brand-primary text-brand-primary bg-white hover:text-white hover:bg-brand-primary"
            >
                New Industry
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if(session('message'))
            <div
                id="session_message"
                class="text-center mb-6 md:text-xl text-green-600"
            >
                {{ session("message") }}
                <script>
                    setTimeout(() => {
                        document.getElementById("session_message").remove();
                    }, 3000);
                </script>
            </div>
            @endif

            <div class="space-y-4">
                @foreach($industries as $industry)
                <div>
                    <div
                        class="
                            flex justify-between items-center gap-2 px-4 py-2 rounded-lg border border-brand-primary
                            {{ request('industry') == $industry->id ? 'bg-brand-primary/15' : 'bg-white' }}
                        "
                    >
                        <div class="flex justify-start items-center gap-2">
                            <div class="text-center">
                                <a
                                    class="px-4 text-sm py-1 rounded-lg bg-sky-500 text-white"
                                    href="{{ route('dashboard.industries.edit', $industry->id) }}"
                                >
                                    Edit
                                </a>
                            </div>
                            <div class="text-left">
                                {{ $industry->name }}
                            </div>
                        </div>
                        <div class="flex justify-center items-center gap-2">
                            <p class="border rounded-lg px-2 py-0.5 text-xs">
                                <span class="text-gray-500">Products:</span>
                                <span class="text-brand-primary">
                                    {{ $industry->products_count }}
                                </span>
                            </p>
                            @if($industry->products_count == 0)
                            <x-action-delete-with-confirmation
                                :href="route('dashboard.industries.destroy', $industry->id)"
                            >
                                <x-icons.outline.trash
                                    class="size-6 cursor-pointer text-red-600"
                                />
                            </x-action-delete-with-confirmation>
                            @else
                            <!-- <x-icons.outline.eye
                                class="size-6 cursor-pointer text-indigo-600"
                            /> -->
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="">
                    <a
                        href="{{ route('dashboard.industries.create') }}"
                        class="px-4 py-1 border rounded-lg cursor-pointer border-brand-primary text-brand-primary bg-white hover:text-white hover:bg-brand-primary"
                    >
                        + Add Industry
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
