<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between gap-2 items-center">
            <a
                href="{{ url('/dashboard/settings') }}"
                class="cursor-pointer text-gray-600 hover:text-gray-900"
            >
                &larr; Back to Settings
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Mission Settings Form") }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

            <form
                method="POST"
                action="{{ url('/dashboard/settings') }}"
                class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 md:p-8 grid gap-4"
                enctype="multipart/form-data"
            >
                @csrf @method('PUT')

                <input type="hidden" name="criteria" value="mission" />

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <div class="text-red-600 text-center">
                            Width: <b>{{ $photo_size['width'] }}px</b>,
                            Height: <b>{{ $photo_size['height'] }}px</b>
                        </div>
                        <div class="flex items-center">
                            <label
                                for="company_mission_thumbnail"
                                class="border w-full cursor-pointer overflow-hidden bg-red-300"
                                {!! 'sty' . 'le="aspect-ratio:' . $photo_size["width"] . '/' . $photo_size["height"] . '"' !!}
                            >
                                <img
                                    id="imagePreview"
                                    src="{{
                                        $settings[
                                            'company_mission_thumbnail'
                                        ] ?? ''
                                    }}"
                                    alt="Thumbnail"
                                    class="w-full object-cover"
                                    {!! 'sty' . 'le="aspect-ratio:' . $photo_size["width"] . '/' . $photo_size["height"] . '"' !!}
                                />
                                <input
                                    name="settings[company_mission_thumbnail]"
                                    id="company_mission_thumbnail"
                                    onchange="previewImage(event, 'imagePreview')"
                                    class="hidden"
                                    type="file"
                                    accept="image/*"
                                />
                            </label>
                        </div>
                        @error('company_mission_thumbnail')
                        <div class="text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <div>
                            <label
                                for="company_mission_headline"
                                class="block text-xl sm:text-2xl font-medium text-gray-400"
                            >
                                Company Mission Headline
                            </label>
                            <textarea
                                rows="3"
                                type="text"
                                id="company_mission_headline"
                                name="settings[company_mission_headline]"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md text-4xl sm:text-5xl"
                                >{{
                                    old("company_mission_headline") ??
                                        ($settings["company_mission_headline"] ??
                                            "")
                                }}</textarea
                            >
                            @error('company_mission_headline')
                            <div class="text-red-500 mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label
                                for="company_mission_description"
                                class="block text-xl sm:text-2xl font-medium text-gray-400"
                            >
                                Company Mission Description
                            </label>
                            <textarea
                                rows="6"
                                type="text"
                                id="company_mission_description"
                                name="settings[company_mission_description]"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md"
                                >{{
                                    old("company_mission_description") ??
                                        ($settings[
                                            "company_mission_description"
                                        ] ??
                                            "")
                                }}</textarea
                            >
                            @error('company_mission_description')
                            <div class="text-red-500 mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr />

                <div class="flex justify-between gap-2 items-center">
                    <a
                        href="{{ url('/dashboard/settings') }}"
                        class="cursor-pointer text-gray-600 hover:text-gray-900"
                    >
                        &larr; Back without save
                    </a>
                    <button
                        type="submit"
                        class="px-4 py-1 border rounded-md cursor-pointer border-green-600 text-green-600 bg-white hover:text-white hover:bg-green-600"
                    >
                        Submit & Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
