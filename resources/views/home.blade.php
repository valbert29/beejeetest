@extends('layouts.app')
<style>
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:before {
        bottom: .5em;
    }
</style>

@section('content')
    <!-- Create Task Form... -->
    <!-- Bootstrap Boilerplate... -->

    <div class="container">
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

    <!-- Current Tasks -->

        <div class="thead-dark">
            <h3>Current Tasks</h3>
        </div>

            <!-- Table Headings -->

        <table class="table table-striped table-dark text-center" data-page-length='3' id=taskTable>
            <thead>
                <tr>
                    <th scope="col-sm">User Name</th>
                    <th>&nbsp;</th>

                    <th scope="col-sm">E-mail</th>
                    <th>&nbsp;</th>

                    <th scope="col-sm">Task</th>
                    <th>&nbsp;</th>

                    <th scope="col-sm">Edited</th>
                    <th>&nbsp;</th>

                    @if($canEditText)
                        <th scope="col-sm">Edit</th>
                        <th>&nbsp;</th>
                    @endif

                    <th scope="col-sm">Delete</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
    @if (count($tasks) > 0)
            <!-- Table Body -->

            <tbody>
            @foreach ($tasks as $task)
                <tr scope="row">
                    <!-- Task Name -->
                    <td scope="col">
                        <div>{{ $task->name }}</div>
                    </td>
                    <th>&nbsp;</th>

                    <td scope="col">
                        <div>{{ $task->email }}</div>
                    </td>
                    <th>&nbsp;</th>

                    <td scope="col">
                        <div style="overflow-wrap: anywhere">{{ $task->text }}</div>
                    </td>
                    <th>&nbsp;</th>

                    <td scope="col">
                        @if($task->edited)
                            <div>
                                <p class="alert-success">
                                    Изменено администратором ✔
                                </p>
                            </div>
                        @endif
                    </td>
                    <th>&nbsp;</th>

                    @if($canEditText)
                        <td scope="col">
                            <form action="/task/edit/{{ $task->id }}" method="GET">
                                {{ csrf_field() }}
                                {{ method_field('GET') }}

                                <button class="btn btn-success">
                                    <img src="https://img.icons8.com/fluent-systems-filled/2x/edit.png"/>
                                </button>
                            </form>
                        </td>
                        <th>&nbsp;</th>
                    @endif

                    <td scope="col">
                        <form action="/task/{{ $task->id}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button class="btn btn-danger">
                                <img src="https://img.icons8.com/carbon-copy/48/000000/filled-trash.png" />
                            </button>
                        </form>
                    </td>
                    <th>&nbsp;</th>
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif
        <script type="application/javascript">
            $(document).ready(function() {
                $('#taskTable').DataTable({
                    "aaSorting": [],
                    columnDefs: [{
                        orderable: false,
                        targets: [1,3,5,7,8,9,10,11]
                    }],
                    "lengthChange": false
                });
            });
            $('.dataTables_length').addClass('bs-select');
        </script>
        <script type="application/javascript" src=https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js></script>
        <script type="application/javascript" src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js></script>
        <script type="application/javascript" src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/dataTables.bootstrap4.min.js></script>
@endsection
