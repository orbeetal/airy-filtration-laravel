<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between gap-2 items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Category List") }}
            </h2>
            <a
                href="{{ route('dashboard.categories.create') }}"
                class="px-4 py-1 border rounded-lg cursor-pointer border-brand-primary text-brand-primary bg-white hover:text-white hover:bg-brand-primary"
            >
                New Category
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
                @foreach($categories as $category)
                <div>
                    <div
                        class="
                            flex justify-between items-center gap-2 px-4 py-2 rounded-t-lg border border-brand-primary
                            {{ request('category') == $category->id ? 'bg-brand-primary/15' : 'bg-white' }}
                        "
                    >
                        <div class="flex justify-start items-center gap-2">
                            <div class="text-center">
                                <a
                                    class="px-4 text-sm py-1 rounded-lg bg-sky-500 text-white"
                                    href="{{ route('dashboard.categories.edit', $category->id) }}"
                                >
                                    Edit
                                </a>
                            </div>
                            <div class="text-left">
                                {{ $category->name }}
                            </div>
                        </div>
                        <div class="flex justify-center items-center gap-2">
                            <p class="border rounded-lg px-2 py-0.5 text-xs">
                                <span class="text-gray-500">Products:</span>
                                <span class="text-brand-primary">
                                    {{ $category->products_count }}
                                </span>
                            </p>
                            @if($category->products_count == 0 &&
                            $category->subcategories_count == 0)
                            <x-action-delete-with-confirmation
                                :href="route('dashboard.categories.destroy', $category->id)"
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
                    <div
                        class="p-3 rounded-b-lg space-y-3 border border-t-0 border-brand-secondary"
                    >
                        @foreach($category->subcategories as $subcategory)
                        <div
                            class="
                                flex justify-between items-center gap-2 px-2 py-1.5 border border-brand-secondary rounded-xl 
                                {{ request('category') == $subcategory->id ? 'bg-yellow-500/25' : 'bg-white' }}
                            "
                        >
                            <div class="flex justify-start items-center gap-2">
                                <a
                                    href="{{ route('dashboard.categories.edit', $subcategory->id) }}"
                                >
                                    <x-icons.outline.pencil-square
                                        class="size-6 cursor-pointer text-sky-600"
                                    />
                                </a>
                                <div class="text-left">
                                    {{ $subcategory->name }}
                                </div>
                            </div>
                            <div class="flex justify-center items-center gap-2">
                                <p
                                    class="border rounded-lg px-2 py-0.5 text-xs"
                                >
                                    <span class="text-gray-500">Products:</span>
                                    <span class="text-brand-primary">
                                        {{ $subcategory->products_count }}
                                    </span>
                                </p>
                                @if($subcategory->products_count == 0)
                                <x-action-delete-with-confirmation
                                    :href="route('dashboard.categories.destroy', $subcategory->id)"
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
                        @endforeach
                        <div class="">
                            <a
                                href="{{
                                    route('dashboard.categories.create', ['parent_id' => $category->id])
                                }}"
                                class="px-4 py-1 border rounded-xl cursor-pointer border-brand-secondary text-brand-seborder-brand-secondary bg-white hover:text-white hover:bg-brand-primary"
                            >
                                + Add Sub Category
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="">
                    <a
                        href="{{ route('dashboard.categories.create') }}"
                        class="px-4 py-1 border rounded-lg cursor-pointer border-brand-primary text-brand-primary bg-white hover:text-white hover:bg-brand-primary"
                    >
                        + Add Category
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
