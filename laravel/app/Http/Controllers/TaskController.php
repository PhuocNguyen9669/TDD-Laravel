<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class TaskController extends Controller
{
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageNumber = session('page');

        $search = '%' . str_replace('%', '\\%', $request->search) . '%';

        $tasks = $this->task->where('name', 'LIKE', $search)->latest('id')
            ->orWhere('content', 'LIKE', $search)
            ->paginate(10)->withQueryString();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTaskRequest $request)
    {
        $this->task->create($request->all());
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = $this->task->findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $key = explode('?', url()->previous());

        if(isset($key[1])){
            session(['key' => $key[1]]);
        }

        $task = $this->task->findOrFail($id);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateTaskRequest $request, string $id)
    {
        $task = $this->task->findOrFail($id);

        $dataUpdate = $request->all();

        $task->update($dataUpdate);

        $query = session('key');

        $query_return = explode('&', $query);

        session()->forget('key');

        return redirect()->route('tasks.index', $query_return);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = $this->task->findOrFail($id);

        $task->delete();

        return redirect()->back();
    }
}
