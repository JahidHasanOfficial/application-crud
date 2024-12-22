<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('id', 'desc')->paginate(10);
        return view('task.index', compact('tasks'));
    }

    public function create()
    {
        return view('task.create');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('home/task', 'public');
            $task->image = $imagePath;
        }
        $task->save();

        return redirect()->route('task.index')->with('success', 'Task created successfully');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('task.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->description = $request->description;
        if ($request->hasFile('image')) {
            $oldLogoPath = $task->image;

            if ($oldLogoPath) {
                $relativePath = str_replace(url('storage/') . '/', '', $oldLogoPath);
                $fullPath = storage_path('app/public/' . $relativePath);

                // Check if the file exists and delete it
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                    // Log::info("Old logo deleted: " . $fullPath);
                } else {
                    // Log::error("File not found for deletion: " . $fullPath);
                }
            }

            $imagePath = $request->file('image')->store('tasks', 'public');
            $task->image = $imagePath;
        }
        $task->save();

        return redirect()->route('task.index')->with('success', 'Task updated successfully');
    }

    public function destroy($id)
    {
        {
            $task = Task::find($id);
            if($task->image)
            {
                $relativePath = str_replace(url('storage/') . '/', '', $task->image);
                $fullPath = storage_path('app/public/' . $relativePath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }
            $task->delete();
        return redirect()->route('task.index')->with('success', 'Task deleted successfully');
    }
    }
}
