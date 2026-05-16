<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [
            [
                'title' => 'Mengerjakan Tugas Laravel',
                'description' => 'Menyelesaikan CRUD aplikasi To-Do List menggunakan Laravel.',
                'priority' => 'High',
                'status' => 'Pending',
                'tags' => ['Study', 'Work'],
                'is_important' => true,
                'due_date' => now()->addDays(2),
            ],
            [
                'title' => 'Belajar TypeScript',
                'description' => 'Memahami dasar-dasar TypeScript dan membuat project sederhana.',
                'priority' => 'Medium',
                'status' => 'In Progress',
                'tags' => ['Study'],
                'is_important' => true,
                'due_date' => now()->addDays(5),
            ],
            [
                'title' => 'Olahraga Pagi',
                'description' => 'Jogging selama 30 menit di sekitar rumah.',
                'priority' => 'Low',
                'status' => 'Completed',
                'tags' => ['Personal'],
                'is_important' => false,
                'due_date' => now()->subDay(),
            ],
            [
                'title' => 'Meeting dengan Tim',
                'description' => 'Diskusi progress project dan pembagian tugas.',
                'priority' => 'High',
                'status' => 'In Progress',
                'tags' => ['Work'],
                'is_important' => true,
                'due_date' => now()->addDay(),
            ],
            [
                'title' => 'Membaca Buku',
                'description' => 'Membaca 20 halaman buku tentang produktivitas.',
                'priority' => 'Low',
                'status' => 'Pending',
                'tags' => ['Personal', 'Study'],
                'is_important' => false,
                'due_date' => now()->addDays(7),
            ],
            [
                'title' => 'Membuat Presentasi',
                'description' => 'Menyiapkan slide presentasi untuk demo aplikasi.',
                'priority' => 'Medium',
                'status' => 'Pending',
                'tags' => ['Work'],
                'is_important' => true,
                'due_date' => now()->addDays(3),
            ],
            [
                'title' => 'Review Code',
                'description' => 'Memeriksa kode dan memberikan feedback.',
                'priority' => 'High',
                'status' => 'Completed',
                'tags' => ['Work', 'Study'],
                'is_important' => true,
                'due_date' => now()->subDays(2),
            ],
            [
                'title' => 'Belajar Bahasa Inggris',
                'description' => 'Latihan speaking selama 1 jam.',
                'priority' => 'Medium',
                'status' => 'Pending',
                'tags' => ['Study', 'Personal'],
                'is_important' => false,
                'due_date' => now()->addDays(4),
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}