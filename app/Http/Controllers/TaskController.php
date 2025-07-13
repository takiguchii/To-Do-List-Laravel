<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new TaskRepository();
    }

    public function index()
    {
        $tasks = $this->repo->all();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $id = uniqid(); // Gera um id
        $title = $request->input('title');
        $task = new Task($id, $title);
        $this->repo->save($task);

        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()->route('tasks.index');
    }
}
