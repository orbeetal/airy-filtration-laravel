@props([ 'href' => '', 'delete_message' => 'Do you want to delete this?',
'confirmText' => 'DELETE', ])

<div x-data="{ open: false, confirmText: '' }">
    <!-- Trigger -->
    <div @click="open = true">
        {{ $slot }}
    </div>

    <!-- Modal -->
    <div
        x-show="open"
        class="fixed z-[99] inset-0 flex justify-center items-center bg-gray-700/50"
    >
        <div
            class="border rounded-lg p-4 bg-white w-full max-w-xs space-y-3 shadow-lg"
            @click.away="open = false"
        >
            <div class="flex justify-center items-center">
                <x-icons.outline.information-circle
                    class="size-12 text-red-600 bg-red-600/30 rounded-full p-1"
                />
            </div>
            <div
                class="text-xl text-center text-red-600"
                x-html="`{{ $delete_message }}`"
            ></div>

            <hr />

            <div>
                <label class="grid gap-1">
                    <span>
                        Type "<i class="font-bold">{{ $confirmText }}</i
                        >" to delete this
                    </span>
                    <input
                        type="text"
                        class="w-full border rounded p-1"
                        x-model="confirmText"
                    />
                </label>
            </div>

            <hr />

            <div class="flex justify-between">
                <!-- Cancel -->
                <input
                    type="button"
                    value="Cancel"
                    @click="open = false; confirmText = ''"
                    class="w-20 py-1 rounded-lg text-center bg-gray-600 text-white cursor-pointer"
                />

                @if($href)
                <!-- Delete -->
                <form action="{{ $href }}" method="POST">
                    @csrf @method('DELETE')
                    <input
                        type="submit"
                        value="Delete"
                        :disabled="confirmText !== `{{ $confirmText }}`"
                        class="w-20 py-1 rounded-lg text-center bg-sky-600 text-white cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
                    />
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
