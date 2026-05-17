<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TaskNeo')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&family=Hanken+Grotesk:wght@300..900&display=swap"
        rel="stylesheet"
    >
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet"
    >
     <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
     

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen pb-20 md:pb-0">
    <!-- Top Navigation -->
    <nav class="fixed top-0 left-0 z-50 flex h-20 w-full items-center justify-between border-b-[3px] border-black bg-background px-6 py-4 neo-shadow">
        <div class="flex items-center gap-8">
            <span class="font-headline text-3xl font-bold uppercase italic">
                To-Do List
            </span>

            <div class="hidden md:flex gap-6">
                <a
                    href="{{ route('tasks.index') }}"
                    class="font-bold text-primary underline decoration-[3px] underline-offset-8"
                >
                    Dashboard
                </a>
            </div>
        </div>

        <a
            href="{{ route('tasks.create') }}"
            class="neo-border neo-shadow neo-press bg-primary-container px-6 py-2 font-bold uppercase transition-all hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none"
        >
            Create Task
        </a>
    </nav>

    <!-- Main Content -->
    <main class="mx-auto max-w-7xl space-y-12 px-6 pt-28">
        @if (session('success'))
            <div
                id="alert-success"
             class="neo-border neo-shadow bg-green-100 p-4 font-semibold text-green-800 transition-all duration-500 ease-in-out opacity-100 translate-y-0">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Bottom Navigation (Mobile) -->
    <nav class="fixed bottom-0 left-0 z-50 flex h-16 w-full items-center justify-around border-t-[3px] border-black bg-surface-container px-4 md:hidden">
        <a
            href="{{ route('tasks.index') }}"
            class="flex flex-col items-center justify-center rounded-full bg-primary-container px-4 py-1"
        >
            <span class="material-symbols-outlined">dashboard</span>
            <span class="text-xs font-semibold">Home</span>
        </a>

        <a
            href="{{ route('tasks.create') }}"
            class="flex flex-col items-center justify-center text-on-surface-variant"
        >
            <span class="material-symbols-outlined">add_box</span>
            <span class="text-xs font-semibold">New Task</span>
        </a>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.getElementById('alert-success');

            if (alert) {
                setTimeout(() => {
                    alert.classList.remove('opacity-100', 'translate-y-0');
                    alert.classList.add('opacity-0', '-translate-y-2');

                    setTimeout(() => {
                        alert.remove();
                    }, 500); 
                }, 3000); 
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>