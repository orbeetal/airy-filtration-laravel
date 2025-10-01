<div class="grid gap-4 lg:grid-cols-12">
    <!-- Image -->
    @if(($category->parent_id ?? (request()->parent_id ?? 0)) === 0)
    <div class="col-span-full">
        <x-image-size-label width="1920" height="600" />
        <div class="flex items-center">
            <label
                for="image"
                class="border w-full aspect-[16/5] cursor-pointer overflow-hidden bg-red-300"
            >
                <img
                    id="imagePreview"
                    src="{{ $category->image ?? '' }}"
                    alt="Banner"
                    class="w-full aspect-[16/5] object-cover"
                />
                <input
                    name="image"
                    id="image"
                    onchange="previewImage(event, 'imagePreview')"
                    class="hidden"
                    type="file"
                    accept="image/*"
                />
            </label>
        </div>
        @error('image')
        <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
    </div>
    @endif

    <!-- Name -->
    <div class="col-span-full">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input value="{{ old('name') ?? $category->name }}" type="text" id="name" name="name" class="mt-1 p-2 w-full border border-gray-300 rounded-md" required>
        @error('name')
        <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Slug -->
    <div class="col-span-full">
        <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
        <input value="{{ old('slug') ?? $category->slug }}" type="text" id="slug" name="slug" class="mt-1 p-2 w-full border border-gray-300 rounded-md" required>
        @error('slug')
        <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>
