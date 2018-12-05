<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * 顯示使用者所有任務的清單。
    *
    * @param  Request  $request
    * @return Response
    */

    public function index(Request $request)
    {
        return view('tasks.index');
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