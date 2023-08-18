@extends('layouts.layout')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Task</div>

                <div class="card-body">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input type="date" name="due_date" class="form-control" value="{{ $task->due_date }}">
                        </div>
                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <div class="form-check">
                                <input type="checkbox" name="priority" class="form-check-input" value="1" {{ $task->priority ? 'checked' : '' }}>
                                <label class="form-check-label" for="priority">High Priority</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
