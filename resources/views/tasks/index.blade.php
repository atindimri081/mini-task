<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniTask</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-3xl mx-auto py-10 px-4">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            MiniTask
        </h1>

        <!-- Add Task -->
        <form action="{{ route('tasks.store') }}" method="POST"
              class="bg-white p-5 rounded-lg shadow mb-6">
            @csrf

            <input
                type="text"
                name="title"
                placeholder="Task title"
                required
                class="w-full border rounded px-3 py-2 mb-3"
            >

            <textarea
                name="description"
                placeholder="Description (optional)"
                class="w-full border rounded px-3 py-2 mb-3"
            ></textarea>

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
            >
                Add Task
            </button>
        </form>

        <!-- Tasks -->
        <div class="space-y-3">

            @forelse ($tasks as $task)

                <div class="bg-white p-4 rounded-lg shadow flex items-center justify-between">

                    <div>
                        <h2 class="font-semibold {{ $task->completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                            {{ $task->title }}
                        </h2>

                        @if ($task->description)
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $task->description }}
                            </p>
                        @endif
                    </div>

                    <div class="flex gap-2">

                        <!-- Complete / Undo -->
                        <form action="{{ route('tasks.update', $task) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="px-3 py-1 rounded bg-green-100 text-green-700"
                            >
                                {{ $task->completed ? 'Undo' : 'Done' }}
                            </button>
                        </form>

                        <!-- Delete -->
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="px-3 py-1 rounded bg-red-100 text-red-700"
                            >
                                Delete
                            </button>
                        </form>

                    </div>

                </div>

            @empty

                <div class="text-center text-gray-500 py-10">
                    No tasks yet.
                </div>

            @endforelse

        </div>

    </div>

</body>
</html>