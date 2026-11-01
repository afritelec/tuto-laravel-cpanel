<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mes tâches</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f3f5fa; color: #081642; margin: 0; }
        main { max-width: 640px; margin: 48px auto; padding: 0 16px; }
        h1 { color: #05308C; margin-bottom: 4px; }
        form { display: flex; gap: 8px; }
        input[type=text] { flex: 1; padding: 10px; border: 1px solid #c9d3ec; border-radius: 6px; font-size: 16px; }
        button { padding: 10px 14px; border: 0; border-radius: 6px; background: #05308C; color: #fff; font-size: 15px; cursor: pointer; }
        ul { list-style: none; padding: 0; }
        li { display: flex; gap: 8px; background: #fff; padding: 10px; border-radius: 8px; margin-top: 8px; }
        li form:nth-child(2) { flex: 1; }
        .done input[type=text] { text-decoration: line-through; color: #7a86a8; }
        .gris { background: #e4e8f3; color: #081642; }
    </style>
</head>
<body>
<main>
    <h1>Mes tâches</h1>
    <p>Une application Laravel et MySQL sur cPanel.</p>

    <form method="post" action="/tasks">
        @csrf
        <input type="text" name="title" placeholder="Nouvelle tâche" required maxlength="255">
        <button>Ajouter</button>
    </form>

    <ul>
        @foreach ($tasks as $task)
            <li class="{{ $task->done ? 'done' : '' }}">
                <form method="post" action="/tasks/{{ $task->id }}/toggle">
                    @csrf @method('patch')
                    <button class="gris">{{ $task->done ? '✓' : '○' }}</button>
                </form>
                <form method="post" action="/tasks/{{ $task->id }}">
                    @csrf @method('put')
                    <input type="text" name="title" value="{{ $task->title }}" required maxlength="255">
                    <button class="gris">Modifier</button>
                </form>
                <form method="post" action="/tasks/{{ $task->id }}">
                    @csrf @method('delete')
                    <button class="gris">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
</main>
</body>
</html>
