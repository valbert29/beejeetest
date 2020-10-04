@extends('layouts.app')
{{--    @include('tasks')--}}
@section('content')
    <!-- Create Task Form... -->
    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <div class="left">
            <h1>Create Task</h1>
        </div>

        <!-- New Task Form -->
        <form action="/task" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Task Name -->
            <div class="form-group">
                <label for="name" class="col-xs-6 col-sm-3 control-label">User Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" maxlength="50" class="form-control">
                </div>

                <label for="email" class="col-xs-6 col-sm-3 control-label">E-mail</label>

                <div class="col-sm-6">
                    <input type="email" name="email" id="task-name" maxlength="30" class="form-control">
                </div>

                <label for="text" class="col-xs-6 col-sm-3 control-label">Task text</label>

                <div class="col-sm-6">
                    <textarea type="text" name="text" id="task-name" maxlength="255" class="form-control" style="max-height: 9vh; min-height: 9vh"></textarea>
                </div>

            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-block btn-dark">
                        <i class="fa fa-plus"></i> Add Task
                    </button>
                </div>
            </div>
        </form>

    </div>

    <!-- Current Tasks -->
    @if (count($tasks) > 0)
        <div class="container">
            <div class="card-body">
                Current Tasks
            </div>

            <div class="container">

                    <!-- Table Headings -->
                    <div class="row">
                        <td class="col-sm">User Name</td>
                        <th>&nbsp;</th>

                        <td class="col-sm">E-mail</td>
                        <th>&nbsp;</th>

                        <td class="col-sm">Task</td>
                        <th>&nbsp;</th>

                        <td class="col-sm">Edit</td>
                        <th>&nbsp;</th>

                        <td class="col-sm">Delete</td>
                    </div>

                    <!-- Table Body -->

                    <tbody>
                    @foreach ($tasks as $task)
                        <div class="row-cols-5">
                            <!-- Task Name -->
                            <div class="col-sm">
                                <div>{{ $task->name }}</div>
                            </div>
                            <th>&nbsp;</th>

                            <div class="col-sm">
                                <div>{{ $task->email }}</div>
                            </div>
                            <th>&nbsp;</th>

                            <div class="col-sm">
                                <div style="overflow-wrap: anywhere">{{ $task->text }}</div>
                            </div>
                            <th>&nbsp;</th>

                            <div class="col-sm">
                                <form action="/task/{{ $task->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button>Edit Task</button>
                                </form>
                            </div>
                            <th>&nbsp;</th>

                            <div class="col-sm">
                                <form action="/task/{{ $task->id, $task->user_id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button>Delete Task</button>
                                </form>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm">
                                    Одна из трёх колонокdsfafafafafsssssssssssssssssssssssssssssssssssssssss
                                </div>
                                <div class="col-sm">
                                    Одна из трёх колонок
                                </div>
                                <div class="col-sm">
                                    Одна из трёх колонок
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
            </div>
        </div>
    @endif
@endsection
