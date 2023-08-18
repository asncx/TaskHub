<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status', 'all');
    
        $tasksQuery = Task::where('user_id', auth()->id());
    
        if ($status === 'completed') {
            $tasksQuery->where('completed', true);
        } elseif ($status === 'not_completed') {
            $tasksQuery->where('completed', false);
        }
    
        $tasks = $tasksQuery->orderBy('created_at', 'desc')
                            ->paginate(5);
    
        return view('main', compact('tasks'));
    }
     
    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'due_date' => 'nullable|date',
        ]);

        $priority = $request->input('priority') === '1';
        
        Task::create([
            'description' => $request->input('description'),
            'due_date' => $request->input('due_date'),
            'user_id' => auth()->id(),
            'priority' => $priority,
        ]);
    
        return redirect('/')->with('new_post_success', 'Task '.$request->input('description').' added.');
    }
    
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

           if ($task->user_id !== auth()->id()) {
              return redirect('/')->with('error', 'You do not have permission to delete the task.');
          }

          $task->delete();

         return redirect('/')->with('success', 'Task deleted.');
    }

    public function complete($id)
    {
          $task = Task::findOrFail($id);

          if ($task->user_id !== auth()->id()) {
            return redirect('/')->with('error', 'You do not have permission to modify the task status.');
         }

         $task->completed = true;
         $task->save();

        return redirect('/')->with('success', 'Task moved to "Completed" status.');
    }

    public function edit(Task $task)
    {
        if (Auth::user()->id !== $task->user_id) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to update this task.');
        }
        return view('edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if (Auth::user()->id !== $task->user_id) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to update this task.');
        }
    
        $request->validate([
            'description' => 'required',
            'due_date' => 'nullable|date',
        ]);
    
        $priority = $request->has('priority');
    
        $task->update([
            'description' => $request->input('description'),
            'due_date' => $request->input('due_date'),
            'priority' => $priority,
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Task updated successfully.');
    }
}
