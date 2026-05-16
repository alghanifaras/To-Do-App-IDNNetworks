@php
    $selectedTags = old('tags', $task->tags ?? []);
@endphp

<div class="mb-10">
    <h1 class="font-headline text-5xl font-bold mb-2">
        {{ isset($task) ? 'Edit Task' : 'Create New Task' }}
    </h1>
    <p class="text-lg opacity-80">
        Populate the details below to organize your productivity.
    </p>
</div>

<div class="neo-border neo-shadow bg-white p-8 rounded-lg">
    <div class="flex flex-col gap-8">
        <div class="flex flex-col gap-2">
            <label for="title" class="font-bold uppercase tracking-wider">Title</label>
            <input
                id="title"
                type="text"
                name="title"
                value="{{ old('title', $task->title ?? '') }}"
                class="w-full bg-white border-2 border-black px-4 py-3 outline-none focus:border-4"
            >
            @error('title')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div class="flex flex-col gap-2">
            <label for="description" class="font-bold uppercase tracking-wider">Description</label>
            <textarea
                id="description"
                name="description"
                rows="4"
                class="w-full bg-white border-2 border-black px-4 py-3 outline-none focus:border-4"
            >{{ old('description', $task->description ?? '') }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Priority -->
            <div class="flex flex-col gap-2">
                <label for="priority" class="font-bold uppercase tracking-wider">Priority</label>
                <select
                    id="priority"
                    name="priority"
                    class="w-full bg-white border-2 border-black px-4 py-3 outline-none focus:border-4"
                >
                    <option value="">Pilih Prioritas</option>
                    @foreach(['Low', 'Medium', 'High'] as $priority)
                        <option
                            value="{{ $priority }}"
                            {{ old('priority', $task->priority ?? '') == $priority ? 'selected' : '' }}
                        >
                            {{ $priority }}
                        </option>
                    @endforeach
                </select>
                @error('priority')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Due Date -->
            <div class="flex flex-col gap-2">
                <label for="due_date" class="font-bold uppercase tracking-wider">Due Date</label>
                <input
                    id="due_date"
                    type="date"
                    name="due_date"
                    value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                    class="w-full bg-white border-2 border-black px-4 py-3 outline-none focus:border-4"
                >
                @error('due_date')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Status -->
        <div class="flex flex-col gap-2">
            <label class="font-bold uppercase tracking-wider">Status</label>
            <div class="flex flex-wrap gap-4">
                @foreach(['Pending', 'In Progress', 'Completed'] as $status)
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            type="radio"
                            name="status"
                            value="{{ $status }}"
                            class="w-5 h-5"
                            {{ old('status', $task->status ?? '') == $status ? 'checked' : '' }}
                        >
                        <span>{{ $status }}</span>
                    </label>
                @endforeach
            </div>
            @error('status')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tags -->
        <div class="flex flex-col gap-2">
            <label class="font-bold uppercase tracking-wider">Tags</label>
            <div class="flex flex-wrap gap-3">
                @foreach(['Work', 'Study', 'Personal', 'Health'] as $tag)
                    <label class="px-4 py-2 border-2 border-black bg-white cursor-pointer hover:bg-tertiary-fixed transition-colors flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="tags[]"
                            value="{{ $tag }}"
                            class="w-4 h-4"
                            {{ in_array($tag, $selectedTags) ? 'checked' : '' }}
                        >
                        <span class="font-bold text-sm">{{ $tag }}</span>
                    </label>
                @endforeach
            </div>
            @error('tags')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Important Toggle -->
        <div class="flex items-center justify-between p-4 bg-surface-container rounded-lg border-2 border-black">
            <div>
                <span class="font-bold uppercase block">Mark as Important</span>
                <span class="text-sm opacity-70">Highlight this task in your dashboard</span>
            </div>

            <label class="relative inline-flex items-center cursor-pointer">
                <input
                    type="checkbox"
                    name="is_important"
                    value="1"
                    class="sr-only peer"
                    {{ old('is_important', $task->is_important ?? false) ? 'checked' : '' }}
                >
                <div class="w-14 h-8 bg-gray-200 border-2 border-black rounded-full peer-checked:bg-primary-container after:content-[''] after:absolute after:top-1 after:left-1 after:bg-black after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:after:translate-x-6"></div>
            </label>
        </div>

        <!-- Footer Actions -->
        <div class="flex flex-col md:flex-row gap-4 mt-4 pt-6 border-t-2 border-black border-dashed">
            <button
                type="submit"
                class="flex-1 neo-border neo-shadow neo-press bg-primary-container py-4 text-2xl font-bold transition-all hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none"
            >
                {{ isset($task) ? 'Update Task' : 'Create Task' }}
            </button>

            <a
                href="{{ route('tasks.index') }}"
                class="flex-1 neo-border neo-shadow neo-press bg-white py-4 text-2xl font-bold text-center transition-all hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none"
            >
                Cancel
            </a>
        </div>
    </div>
</div>