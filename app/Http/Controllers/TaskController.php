<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        $tasks = Task::where('user_id', auth()->user()->id)->get();
        return response()->json($tasks, 200);
    }
    public function sortBy(Request $request)
    {
        if ($request->sortBy == "default") {
            $tasks = Task::where('user_id', auth()->user()->id)->get();
            return response()->json($tasks, 200);
        }
        $tasks = Task::where('user_id', auth()->user()->id)->orderBy($request->sortBy)->get();
        return response()->json($tasks, 200);
    }
    public function filterBy(Request $request)
    {
        if ($request->filterBy === 'all') {
            $tasks = Task::where('user_id', auth()->user()->id)->get();
            return response()->json($tasks, 200);
        }
        $tasks = Task::where('user_id', auth()->user()->id)->where("status", $request->filterBy)->get();
        return response()->json($tasks, 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|in:in_progress,completed',
        ]);

        $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            // 'due_date' => Carbon::createFromFormat('m/d/Y', $request->input('due_date'))->format('Y-m-d H:i:s'),
            'due_date' => Carbon::createFromFormat('Y-m-d', $request->input('due_date'))->format('Y-m-d H:i:s'),
            'status' => $request->input('status'),
            'user_id' => auth()->user()->id,
        ]);
        return response()->json($task, 201);
        // return response()->json($request, 201);
    }
    public function show($id)
    {
        $task = Task::find($id);
        return response()->json($task, 200);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|in:in_progress,completed',
        ]);

        $task = Task::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            // 'due_date' => Carbon::createFromFormat('m/d/Y', $request->input('due_date'))->format('Y-m-d H:i:s'),
            'due_date' => Carbon::createFromFormat('Y-m-d', $request->input('due_date'))->format('Y-m-d H:i:s'),
            'status' => $request->input('status'),
        ]);

        return response()->json($task, 200);
    }

    public function destroy($id)
    {
        $task = Task::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
