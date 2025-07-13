<?php

namespace App\Models;

class Task
{
    public $id;
    public $title;
    public $done;

    public function __construct($id, $title, $done = false)
    {
        $this->id = $id;
        $this->title = $title;
        $this->done = $done;
    }

    public function markAsDone()
    {
        $this->done = true;
    }

    public function markAsUndone()
    {
        $this->done = false;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'done' => $this->done,
        ];
    }

    public static function fromArray(array $data)
    {
        return new self($data['id'], $data['title'], $data['done']);
    }
}
