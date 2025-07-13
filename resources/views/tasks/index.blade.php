<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        ul { padding: 0; list-style: none; }
        li { margin-bottom: 8px; }
        form { display: inline; }
    </style>
</head>
<body>
    <h1>Minhas Tarefas</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Nova tarefa" required>
        <button type="submit">Adicionar</button>
    </form>

    <ul>
        @forelse ($tasks as $task)
            <li>
                {{ $task->title }}
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">🗑️</button>
                </form>
            </li>
        @empty
            <li>Você ainda não adicionou nenhuma tarefa.</li>
        @endforelse
    </ul>
</body>
</html>
