<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            color: #1f2937;
        }
        .container {
            max-width: 700px;
            margin: 60px auto;
            padding: 20px;
        }
        .card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
            padding: 24px;
        }
        .header {
            margin-bottom: 18px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        input, select, textarea, button {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 14px;
            box-sizing: border-box;
        }
        textarea {
            min-height: 100px;
            resize: vertical;
        }
        button {
            cursor: pointer;
            border: none;
            font-weight: 700;
            background: #2563eb;
            color: white;
        }
        .actions {
            display: flex;
            gap: 10px;
            margin-top: 18px;
        }
        .secondary {
            background: #f3f4f6;
            color: #1f2937;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            padding: 10px 12px;
        }
        .error-box {
            margin-top: 14px;
            padding: 12px 14px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            color: #991b1b;
        }
        .error-box ul {
            margin: 8px 0 0 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>Edit Task</h1>
            </div>

            <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    <div>
                        <label for="task_name">Task Name</label>
                        <input id="task_name" name="task_name" type="text" value="{{ old('task_name', $task->task_name) }}" required>
                    </div>
                    <div>
                        <label for="due_date">Due Date</label>
                        <input id="due_date" name="due_date" type="date" value="{{ old('due_date', $task->due_date->format('Y-m-d')) }}" required>
                    </div>
                    <div>
                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label for="description">Description</label>
                        <textarea id="description" name="description">{{ old('description', $task->description) }}</textarea>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="error-box">
                        <strong>Please correct the following:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="actions">
                    <button type="submit">Update Task</button>
                    <a href="{{ route('tasks.index') }}" class="secondary">Back to List</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
