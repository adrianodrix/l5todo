<?php namespace App\Http\Controllers;

use App\Project;
use App\Task;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Redirect;
use App\User;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    protected $rules = [
        'name' => ['required', 'min:3'],
        'description' => ['required'],
        'user' => ['exists:users']
    ];

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Project $project
     * @return Response
     */
    public function index(Project $project)
    {
        return view('tasks.index', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Project $project
     * @return Response
     */
    public function create(Project $project)
    {
        $users = User::lists('name', 'id');
        return view('tasks.create', compact('project', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Project $project
     * @return Response
     */
    public function store(Project $project, Request $request)
    {
        $this->validate($request, $this->rules);

        $input = Input::all();
        $input['project_id'] = $project->id;
        Task::create( $input );

        return Redirect::route('projects.show', $project->slug)->with('message', 'Task created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project $project
     * @param  \App\Task    $task
     * @return Response
     */
    public function show(Project $project, Task $task)
    {
        return view('tasks.show', compact('project', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project $project
     * @param  \App\Task    $task
     * @return Response
     */
    public function edit(Project $project, Task $task)
    {
        $users = User::lists('name', 'id');
        return view('tasks.edit', compact('project', 'task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Project $project
     * @param  \App\Task    $task
     * @return Response
     */
    public function update(Project $project, Task $task, Request $request)
    {
        $this->validate($request, $this->rules);

        $input = array_except(Input::all(), '_method');
        $task->update($input);

        return Redirect::route('projects.tasks.show', [$project->slug, $task->slug])->with('message', 'Task updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project $project
     * @param  \App\Task    $task
     * @return Response
     */
    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return Redirect::route('projects.show', $project->slug)->with('message', 'Task deleted.');
    }

}