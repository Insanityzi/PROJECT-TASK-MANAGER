<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            color: #1f2937;
        }
        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            padding: 24px 28px;
            border-radius: 18px;
            margin-bottom: 24px;
        }
        .header h1 {
            margin: 0;
            font-size: 32px;
        }
        .card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
            padding: 24px;
            margin-bottom: 24px;
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
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
            min-height: 90px;
            resize: vertical;
        }
        button {
            cursor: pointer;
            border: none;
            font-weight: 700;
        }
        .primary-btn {
            background: #2563eb;
            color: white;
        }
        .secondary-btn {
            background: #f3f4f6;
            color: #1f2937;
        }
        .danger-btn {
            background: #dc2626;
            color: white;
        }
        .status-badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .pending {
            background: #fef3c7;
            color: #92400e;
        }
        .completed {
            background: #dcfce7;
            color: #166534;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }
        th, td {
            padding: 16px 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        th {
            background: #f8fafc;
        }
        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        .flash {
            padding: 14px 16px;
            margin-bottom: 18px;
            border-radius: 10px;
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .error-box {
            margin-top: 14px;
            padding: 12px 14px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: 8px;
        }
        .error-box ul {
            margin: 8px 0 0 18px;
        }
        .inline-form {
            display: inline-block;
        }
        .status-select {
            min-width: 120px;
        }
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead {
                display: none;
            }
            td {
                padding: 12px 0;
                border-bottom: none;
            }
            .actions {
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Personal Task Manager</h1>
            <span>{{ $tasks->count() }} Tasks</span>
        </div>

        @if (session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif

        <div class="card">
            <h2>Add New Task</h2>
            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf
                <div class="form-grid">
                    <div>
                        <label for="task_name">Task Name</label>
                        <input id="task_name" name="task_name" type="text" value="{{ old('task_name') }}" required>
                    </div>
                    <div>
                        <label for="due_date">Due Date</label>
                        <input id="due_date" name="due_date" type="date" value="{{ old('due_date') }}" required>
                    </div>
                    <div>
                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div style="grid-column: 1 / -1;">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="Add task details...">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div style="margin-top: 18px;">
                    <button type="submit" class="primary-btn">Save Task</button>
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
            </form>
        </div>

        <div class="card">
            <h2>Task List</h2>
            @if ($tasks->isEmpty())
                <p>No tasks have been added yet.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Task Name</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td><strong>{{ $task->task_name }}</strong></td>
                                <td>{{ $task->description ?: 'No description provided.' }}</td>
                                <td>{{ $task->due_date->format('F d, Y') }}</td>
                                <td>
                                    <span class="status-badge {{ strtolower($task->status) }}">{{ $task->status }}</span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('tasks.edit', $task) }}" class="secondary-btn" style="display:inline-block; text-decoration:none; padding: 9px 12px; border-radius: 10px; text-align:center;">Edit</a>

                                        <form class="inline-form" method="POST" action="{{ route('tasks.status', $task) }}">
                                            @csrf
                                            @method('PATCH')
                                            <select class="status-select" name="status" onchange="this.form.submit()">
                                                <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </form>

                                        <form class="inline-form" method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="danger-btn" style="padding: 9px 12px;">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</body>
</html>
