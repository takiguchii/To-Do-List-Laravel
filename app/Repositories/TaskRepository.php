<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    protected $file = 'tasks.json';

    public function all()
    {
        $tasks = $this->load();
        return array_map(fn($t) => Task::fromArray($t), $tasks);
    }

    public function save(Task $task)
    {
        $tasks = $this->load();
        $tasks[] = $task->toArray();
        $this->store($tasks);
    }

    public function delete($id)
    {
        $tasks = $this->load();
        $tasks = array_filter($tasks, fn($t) => $t['id'] != $id);
        $this->store(array_values($tasks));
    }

    private function load()
    {
        if (!file_exists(storage_path($this->file))) {
            return [];
        }

        $data = file_get_contents(storage_path($this->file));
        return json_decode($data, true) ?? [];
    }

    private function store(array $tasks)
    {
        file_put_contents(storage_path($this->file), json_encode($tasks, JSON_PRETTY_PRINT));
    }
}
