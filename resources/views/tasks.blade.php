
@section('')

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

    <!-- TODO: Current Tasks -->
@endsection
