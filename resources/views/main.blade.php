@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        @auth
        @else
            <h4 class="mt-1">Welcome to To-Do!</h4>
            <p>Plan your day so you don't miss anything. If you haven't registered yet, do it today.</p>

            <form action="/login" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        @endauth

        @auth
            <div class="row">
                <div class="col">

                    @if (session('new_post_success'))
                        <div class="alert alert-success">
                            {{ session('new_post_success') }}
                        </div>
                    @endif

                    <form action="{{ route('tasks.index') }}" method="GET" class="mb-3">
                        <div class="form-group">
                            <label for="status">Filter by Status:</label>
                            <select name="status" class="form-control">
                                <option value="all">All</option>
                                <option value="completed">Completed</option>
                                <option value="not_completed">Not Completed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>

                    @if ($tasks->isEmpty())
                        <h1>My Tasks</h1>
                        <p>No tasks found.</p>
                </div>
                <div class="col">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr class="{{ $task->priority ? 'high-priority' : '' }}">
                                    <td class="{{ $task->priority ? 'text-danger' : '' }}">{{ $task->description }}</td>
                                    <td>{{ $task->due_date instanceof \Carbon\Carbon ? $task->due_date->format('Y-m-d') : \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        @if (!$task->completed)
                                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success"
                                                    data-task-id="{{ $task->id }}">Complete</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>



                    {{ $tasks->links() }}

                </div>
                @endif

                <div class="col">
                    <h1>Create Task</h1>
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input type="date" name="due_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <div class="form-check">
                                <input type="hidden" name="priority" value="0">
                                <input type="checkbox" name="priority" class="form-check-input" value="1">
                                <label class="form-check-label" for="priority">High Priority</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        @endauth

    @endsection

</div>
