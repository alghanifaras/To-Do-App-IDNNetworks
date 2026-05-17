@extends('layouts.app')

@section('title', 'Task Board')

@section('content')
    <!-- Summary Cards -->
    <section class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
        <div class="neo-border neo-shadow bg-surface p-6">
            <div class="neo-border mb-4 flex h-12 w-12 items-center justify-center bg-primary-container">
                <span class="material-symbols-outlined">assignment</span>
            </div>
            <h3 class="text-2xl font-bold">{{ $tasks->count() }}</h3>
            <p class="text-sm text-on-surface-variant">Total Tasks</p>
        </div>

        <div class="neo-border neo-shadow bg-surface p-6">
            <div class="neo-border mb-4 flex h-12 w-12 items-center justify-center bg-error-container">
                <span class="material-symbols-outlined">priority_high</span>
            </div>
            <h3 class="text-2xl font-bold">{{ $tasks->where('priority', 'High')->count() }}</h3>
            <p class="text-sm text-on-surface-variant">High Priority</p>
        </div>

        <div class="neo-border neo-shadow bg-surface p-6">
            <div class="neo-border mb-4 flex h-12 w-12 items-center justify-center bg-secondary-container">
                <span class="material-symbols-outlined">pending</span>
            </div>
            <h3 class="text-2xl font-bold">{{ $tasks->where('status', 'Pending')->count() }}</h3>
            <p class="text-sm text-on-surface-variant">Pending</p>
        </div>

        <div class="neo-border neo-shadow bg-surface p-6">
            <div class="neo-border mb-4 flex h-12 w-12 items-center justify-center bg-tertiary-fixed">
                <span class="material-symbols-outlined">check_circle</span>
            </div>
            <h3 class="text-2xl font-bold">{{ $tasks->where('status', 'Completed')->count() }}</h3>
            <p class="text-sm text-on-surface-variant">Completed</p>
        </div>
    </section>

    <!-- Task Board -->

    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-left neo-border neo-shadow">
            <thead>
                <tr class="border-b-[3px] border-black bg-surface-container-low">
                    <th class="p-4 font-bold uppercase">Task Title</th>
                    <th class="hidden p-4 font-bold uppercase lg:table-cell">Description</th>
                    <th class="p-4 font-bold uppercase">Priority</th>
                    <th class="p-4 font-bold uppercase">Due Date</th>
                    <th class="hidden p-4 font-bold uppercase md:table-cell">Tags</th>
                    <th class="p-4 font-bold uppercase">Status</th>
                    <th class="p-4 text-right font-bold uppercase">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($tasks as $task)
                    <tr class="border-b-2 border-black bg-surface hover:bg-tertiary-fixed">
                        <td class="p-4 font-bold">
                            {{ $task->title }}
                            @if ($task->is_important)
                                <span class="text-red-600">⭐</span>
                            @endif
                        </td>

                        <td class="hidden p-4 text-sm text-on-surface-variant lg:table-cell">
                            {{ $task->description }}
                        </td>

                        <td class="p-4">
                            <span class="neo-border bg-white px-3 py-1 text-xs font-bold uppercase">
                                {{ $task->priority }}
                            </span>
                        </td>

                        <td class="p-4 text-sm">
                            {{ $task->due_date->format('d M Y') }}
                        </td>

                        <td class="hidden p-4 md:table-cell">
                            @foreach ($task->tags ?? [] as $tag)
                                <span
                                    class="neo-border mr-1 bg-secondary-container px-2 py-1 text-[10px] font-bold uppercase">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </td>

                        <td class="p-4">
                            {{ $task->status }}
                        </td>

                        <td class="p-4 text-right">
                            <a href="{{ route('tasks.edit', $task) }}"
                                class="material-symbols-outlined rounded p-1 hover:bg-primary-container">
                                edit
                            </a>

                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline delete-form"
                                data-task-title="{{ $task->title }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="material-symbols-outlined rounded p-1 hover:bg-error-container">
                                    delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-on-surface-variant">
                            Belum ada task.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const taskTitle = form.dataset.taskTitle;

                    Swal.fire({
                        title: 'Hapus Task?',
                        html: `
                    <p class="text-base font-semibold">
                        Task <span class="font-bold">"${taskTitle}"</span> akan dihapus permanen.
                    </p>
                `,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        customClass: {
                            popup: 'neo-border neo-shadow bg-surface rounded-none',
                            title: 'font-headline text-3xl font-bold uppercase italic',
                            htmlContainer: 'font-semibold',
                            confirmButton: 'neo-border neo-shadow neo-press bg-error-container px-6 py-3 font-bold uppercase text-black rounded-none',
                            cancelButton: 'neo-border neo-shadow neo-press bg-surface-container px-6 py-3 font-bold uppercase text-black rounded-none mr-5'
                        },
                        buttonsStyling: false,
                        background: '#ffffff',
                        color: '#000000'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
