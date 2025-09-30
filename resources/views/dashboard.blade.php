<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Dashboard") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div
            class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 grid gap-4 md:gap-6 lg:gap-8 grid-cols-2 md:grid-cols-3 lg:grid-cols-3"
        >
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <a
                    href="/dashboard/categories"
                    class="flex flex-col justify-center gap-4 items-center p-6 text-center"
                >
                    <x-icons.solid.cube
                        class="size-6 md:size-10 lg:size-16 text-brand-primary"
                    />
                    <span class="md:text-xl lg:text-2xl">Categories</span>
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <a
                    href="/dashboard/industries"
                    class="flex flex-col justify-center gap-4 items-center p-6 text-center"
                >
                    <x-icons.solid.home-modern
                        class="size-6 md:size-10 lg:size-16 text-brand-primary"
                    />
                    <span class="md:text-xl lg:text-2xl">Industries</span>
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <a
                    href="/dashboard/products"
                    class="flex flex-col justify-center gap-4 items-center p-6 text-center"
                >
                    <x-icons.solid.circle-stack
                        class="size-6 md:size-10 lg:size-16 text-brand-primary"
                    />
                    <span class="md:text-xl lg:text-2xl">Products</span>
                </a>
            </div>
            <!-- <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <a
                    href="/dashboard/equipments"
                    class="flex flex-col justify-center gap-4 items-center p-6 text-center"
                >
                    <x-icons.solid.circle-stack
                        class="size-6 md:size-10 lg:size-16 text-brand-primary"
                    />
                    <span class="md:text-xl lg:text-2xl">Equipments</span>
                </a>
            </div> -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <a
                    href="/dashboard/banners"
                    class="flex flex-col justify-center gap-4 items-center p-6 text-center"
                >
                    <x-icons.solid.square-3-stack-3d
                        class="size-6 md:size-10 lg:size-16 text-brand-primary"
                    />
                    <span class="md:text-xl lg:text-2xl">Banners</span>
                </a>
            </div>
            <!-- <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <a
                    href="/dashboard/blogs"
                    class="flex flex-col justify-center gap-4 items-center p-6 text-center"
                >
                    <x-icons.solid.newspaper
                        class="size-6 md:size-10 lg:size-16 text-brand-primary"
                    />
                    <span class="md:text-xl lg:text-2xl">Blog</span>
                </a>
            </div> -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <a
                    href="/dashboard/users"
                    class="flex flex-col justify-center gap-4 items-center p-6 text-center"
                >
                    <x-icons.solid.user-group
                        class="size-6 md:size-10 lg:size-16 text-brand-primary"
                    />
                    <span class="md:text-xl lg:text-2xl">Admin Users</span>
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <a
                    href="/dashboard/settings"
                    class="flex flex-col justify-center gap-4 items-center p-6 text-center"
                >
                    <x-icons.solid.cog-8-tooth
                        class="size-6 md:size-10 lg:size-16 text-brand-primary"
                    />
                    <span class="md:text-xl lg:text-2xl">Settings</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
