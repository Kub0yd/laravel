<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo\Task;
use App\Models\User;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = Task::with(['user', 'users', 'secret'])->get();
        $users = User::all();
        return view('todo.index', compact('tasks', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $task = new Task();
            $task->title = $request->title;
            $task->content = $request->content;
            $task->user_id = $request->customer;
            $task->save();

            $task->users()->attach($request->executors);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $task = Task::find($id);
            $task->users()->detach();
            $task->delete();

        } catch (\Exception $e) {
            dd($e->gerMessage());
        }
        return back();
    }
}

