<div class="grid gap-4 lg:grid-cols-12">
    <!-- Name -->
    <div class="col-span-full">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input value="{{ old('name') ?? $industry->name }}" type="text" id="name" name="name" class="mt-1 p-2 w-full border border-gray-300 rounded-md" required>
        @error('name')
        <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Slug -->
    <div class="col-span-full">
        <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
        <input value="{{ old('slug') ?? $industry->slug }}" type="text" id="slug" name="slug" class="mt-1 p-2 w-full border border-gray-300 rounded-md" required>
        @error('slug')
        <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>
