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
                    href="/dashboard/contact/settings"
                    class="flex flex-col justify-center gap-4 items-center p-6 text-center"
                >
                    <x-icons.solid.at-symbol
                        class="size-6 md:size-10 lg:size-16 text-brand-primary"
                    />
                    <span class="md:text-xl lg:text-2xl">Contact Settings</span>
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <a
                    href="/dashboard/about/settings"
                    class="flex flex-col justify-center gap-4 items-center p-6 text-center"
                >
                    <x-icons.solid.home-modern
                        class="size-6 md:size-10 lg:size-16 text-brand-primary"
                    />
                    <span class="md:text-xl lg:text-2xl">About Settings</span>
                </a>
            </div>
            
            <!-- <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <a
                    href="/dashboard/product/settings"
                    class="flex flex-col justify-center gap-4 items-center p-6 text-center"
                >
                    <x-icons.solid.rocket-launch
                        class="size-6 md:size-10 lg:size-16 text-brand-primary"
                    />
                    <span class="md:text-xl lg:text-2xl">Product Section</span>
                </a>
            </div> -->
            <!-- <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <a
                    href="/dashboard/service/settings"
                    class="flex flex-col justify-center gap-4 items-center p-6 text-center"
                >
                    <x-icons.solid.wrench-screwdriver
                        class="size-6 md:size-10 lg:size-16 text-brand-primary"
                    />
                    <span class="md:text-xl lg:text-2xl">Service Section</span>
                </a>
            </div> -->
        </div>
    </div>
</x-app-layout>
