<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\TaskRepository;
use App\Task;


class TaskController extends Controller
{
    /**
     * 任務資源庫的實例。
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * 建立新的控制器實例。
     *
     * @param  TaskRepository  $tasks
     * @return void
     */

    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
    * 顯示使用者所有任務的清單。
    *
    * @param  Request  $request
    * @return Response
    */

    public function index(Request $request)
    {
        $tasks = Task::where('user_id', $request->user()->id)->get();
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');

    }
}