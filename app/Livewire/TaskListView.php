<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use Livewire\WithPagination;

class TaskListView extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $editTaskId;
    public $confirmDeleteId;
    public $updatedDescription;
    public $updatedDueDate;
    public $updatedPriority;

    public function editTask($taskId)
    {
        $this->editTaskId = $taskId;
        $task = Task::find($taskId);

        if ($task) {
            $this->updatedDescription = $task->description;
            $this->updatedDueDate = $task->due_date;
            $this->updatedPriority = $task->priority;
        }
    }

    public function saveTask($taskId)
    {
        $task = Task::find($taskId);

        if ($task) {
            $task->description = $this->updatedDescription;
            $task->due_date = $this->updatedDueDate;
            $task->priority = $this->updatedPriority;
            $task->save();
        }

        $this->editTaskId = null; // Visszaállítjuk az editTaskId-t nullra
    }

    public function cancelEdit()
    {
        $this->editTaskId = null; // Visszaállítjuk az editTaskId-t nullra
    }

    public function confirmDelete($taskId)
    {
        $this->confirmDeleteId = $taskId;
    }

    public function cancelDelete()
    {
        $this->confirmDeleteId = null;
    }

    public function deleteTask($taskId)
    {
        $task = Task::find($taskId);

        if ($task) {
            $task->delete();
        }

        $this->confirmDeleteId = null; // Visszaállítjuk a confirmDeleteId-t nullra
    }

    public function render()
    {
        $tasks = Task::paginate(5);

        return view('livewire.task-list-view', ['tasks' => $tasks]);
    }
}
