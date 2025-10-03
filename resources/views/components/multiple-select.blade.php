@props([
    'name', 
    'options' => [], // [{id: 1, name: "X"}, ...]
    'selected' => [],
    'placeholder' => '-- Select --'
])

<div 
    x-data="{
        open: false,
        selected: @js($selected),
        options: @js($options),
        toggle(id) {
            if (this.selected.includes(id)) {
                this.selected = this.selected.filter(i => i !== id);
            } else {
                this.selected.push(id);
            }
        },
        remove(id) {
            this.selected = this.selected.filter(i => i !== id);
        }
    }"
    class="relative w-full"
>
    <!-- Hidden input -->
    <template x-for="id in selected" :key="id">
        <input type="hidden" name="{{ $name }}[]" :value="id">
    </template>

    <!-- Selected Box -->
    <div 
        @click="open = !open" 
        class="border border-gray-300 rounded-md p-2 cursor-pointer flex flex-wrap gap-1 min-h-[40px]"
    >
        <template x-if="selected.length === 0">
            <span class="text-gray-400">{{ $placeholder }}</span>
        </template>

        <template x-for="id in selected" :key="id">
            <span 
                class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm flex items-center gap-1"
            >
                <span x-text="options.find(o => o.id === id)?.name"></span>
                <button 
                    type="button" 
                    @click.stop="remove(id)" 
                    class="ml-1 text-red-500 hover:text-red-700 font-bold"
                >
                    ×
                </button>
            </span>
        </template>
    </div>

    <!-- Dropdown -->
    <div 
        x-show="open" 
        @click.away="open = false"
        class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto"
    >
        <template x-for="opt in options" :key="opt.id">
            <div 
                @click="toggle(opt.id)" 
                class="px-3 py-2 hover:bg-gray-100 cursor-pointer flex items-center justify-between"
            >
                <span x-text="opt.name"></span>
                <span x-show="selected.includes(opt.id)">✔</span>
            </div>
        </template>
    </div>
</div>
