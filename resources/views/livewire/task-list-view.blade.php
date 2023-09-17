<div class="text-center">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Task</th>
                <th>Due Date</th>
                <th>Priority</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>{{ $task->priority ? 'High Priority' : 'Low Priority' }}</td>
                    <td>
                        @if ($editTaskId === $task->id)
                            <form wire:submit.prevent="saveTask({{ $task->id }})">
                                <input type="text" wire:model="updatedDescription">
                                <input type="date" wire:model="updatedDueDate">
                                <input type="checkbox" wire:model="updatedPriority">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button wire:click="cancelEdit" class="btn btn-secondary">Cancel</button>
                            </form>
                        @else
                            <button wire:click="editTask({{ $task->id }})" class="btn btn-primary">Edit</button>
                            <button wire:click="confirmDelete({{ $task->id }})" class="btn btn-danger">Delete</button>
                            @if ($confirmDeleteId === $task->id)
                                <div class="alert alert-warning">
                                    Are you sure you want to delete this task?
                                    <button wire:click="deleteTask({{ $task->id }})" class="btn btn-danger btn-sm">Yes</button>
                                    <button wire:click="cancelDelete" class="btn btn-secondary btn-sm">No</button>
                                </div>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tasks->links() }}
</div>