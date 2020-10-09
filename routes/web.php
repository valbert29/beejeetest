<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\Task;
use App\Models\TaskUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    $user = \App\Models\User::findOrFail(4);
//    $admin = Role::where('slug', 'admin')->first();
//    $editTasks = Permission::where('slug','edit-tasks')->first();
//    $user->roles()->attach($admin);
//    $user->permissions()->attach($editTasks);
//    dd($user->hasPermission('edit-tasks'));
    return redirect('/home');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/task', function (Request $request) {
    $id = $request->id ?? null;
    if ($id !== null) {
        $task = Task::findOrFail($id);
        $user = TaskUsers::findOrFail($task->user_id);

        if ($request->name !== null && $user->name !== $request->name) {
            $user->name = $request->name;
        }
        if ($request->email !== null && $user->email !== $request->email) {
            $user->email = $request->email;
        }
        if ($task->text !== $request->text) {
            $task->text = $request->text;
        }
        $task->edited = true;
        try {
            $user->save();
            $task->save();
        } catch (InvalidArgumentException $e) {
            $user->rollback();
            $task->rollback();
        }

        return redirect('/home');
    }

    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $user = TaskUsers::create([
        'name' => $request->name,
        'email' => $request->email
    ]);
    try {
        $user->save();
        $task = new Task;
        $task->text = $request->text;
        $task->user_id = $user->id;
        try {
            $task->save();
        } catch (InvalidArgumentException $e) {
            $task->rollback();
        }
    } catch (InvalidArgumentException $e) {
        $user->rollback();
    }

    return redirect('/home');
});

Route::get('/home', function () {
    $tasks = \Illuminate\Support\Facades\DB::table('tasks')
        ->join('task_users', 'tasks.user_id', '=', 'task_users.id')
        ->select(
            'tasks.id', 'tasks.user_id', 'tasks.text', 'task_users.name', 'task_users.email', 'tasks.edited'
        )
        ->get();

    return view('home', [
        'tasks' => $tasks,
        'canEditText' => Gate::allows('edit-tasks')
    ]);
});

Route::delete('/task/{id}', function ($id) {
    $task = Task::findOrFail($id);
    $task->delete();
    $user_id = $task->user_id;
    TaskUsers::findOrFail($user_id)->delete();
    return redirect('/home');
});

Route::get('/task/edit/{id}', function ($id) {
    $task = Task::findOrFail($id);
    $user = TaskUsers::findOrFail($task->user_id);
    return view(
        'edit',
        [
            'id' => $task->id,
            'name' => $user->name,
            'email' => $user->email,
            'text' => $task->text,
            'canEditText' => Gate::allows('edit-tasks'),
        ]
    );
});
