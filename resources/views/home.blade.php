@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Todo List</div>
            <div class="card-body">
                <button type="button" id="add_entry" class="btn btn-primary add mb-3">
                    Add New Entry
                </button>
                <table id="todo_table" class="table">
                    <thead>
                    <tr>
                        <th scope="col">Task</th>
                        <th scope="col">Description</th>
                        <th scope="col" >Complete By</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="entry_modal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="todo_form">
                        <div class="form-group">
                            <label for="task">Task</label>
                            <input type="text" class="form-control" name="task" id="task">
                        </div>
                        <div class="form-group">
                            <label for="description">Further Details</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="complete_by">Complete By</label>
                            <input type="date" class="form-control" id="complete_by" name="complete_by" value="2018-07-22" min="2018-01-01">
                        </div>
                    </form>
                    <div id="validation_errors" class="alert alert-danger" role="alert" style="display: none">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="store_todo" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script>
       const today = moment().format('Y-MM-DD');

       let todoTable = $('#todo_table').DataTable({
           responsive: true,
           columnDefs: [
               {
                   targets: 1,
                   className: "text-truncate"
               },
               {
                   targets: 2,
                   className: "text-center"
               },
               {
                   targets: 3,
                   className: "text-center",
                   render: function (data, type, row, meta) {
                       let checked = '';

                       if (data == '1') {
                           checked = 'checked="checked"';
                       }

                       if (type === 'display') {
                           return '<input id="task_' + row.id + '" type="checkbox" class="task-status" data-id="' + row.id + '" ' + checked + '>';
                       } else {
                           return data;
                       }
                   }
               },
               {
                   targets: 4,
                   className: "text-right",
                   render: function (data, type, row, meta) {
                       let html = '';
                       html += '<button type="button" class="btn btn-info text-white action-button edit mr-2" data-id="' + data.id + '" title="Edit Entry"><i class="fa fa-eye"></i></button>';
                       html += '<button type="button" class="btn btn-secondary text-white action-button view mr-2" data-id="' + data.id + '" title="Edit Entry"><i class="fa fa-edit"></i></button>';
                       html += '<button type="button" class="btn btn-danger text-white action-button delete mr-2" data-id="' + data.id + '" title="Edit Entry"><i class="fa fa-trash"></i></button>';

                       if (type === 'display') {
                           return html;
                       } else {
                           return data;
                       }

                   }
               }
           ],
           "ajax": {
               "url": "/api/tasks",
               "dataSrc": ""
           },
           "columns": [
               {"data": "task"},
               {"data": "description"},
               {"data": "complete_by"},
               {"data": "status"},
               {"data": "id"},
           ]
       });

        $(function (e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#add_entry').on('click', function (e){
                $('#entry_modal').modal('show')
                $('#entry_modal h5').text('Add Task')
            });

            $('#entry_modal').on('hide.bs.modal', function () {
               $('#entry_modal .form-control').val('');
                $('#complete_by').val(today);
                hideValidationErrors();
            })

            //complete by pre-populate and validation
            $('#complete_by').val(today).attr('min', today);

            $('#store_todo').on('click', function (e){
                e.preventDefault();
                let formData = new FormData($('#todo_form')[0]);
                $.ajax({
                    url: "/api/task",
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function (data) {
                    reloadTodoTable();
                    $('#entry_modal').modal('hide')
                }).fail(function (data) {
                    displayValidationErrors(data.responseJSON.errors);
                });
            });

            //remove validation error on input on focus
            $('.form-control').on('focus', function () {
                $(this).removeClass('is-invalid');
            });
        })

       function hideValidationErrors() {
           $('#validation_errors').hide().html("");
           $('.form-control').removeClass('is-invalid');
       }

       function displayValidationErrors(errors){
           hideValidationErrors();
           $('#validation_errors').show();
           $.each(errors, function (key, value) {
               $('#validation_errors').append('<p class="card-text">' + value[0] + '</p>')
               $('#' + key).addClass('is-invalid');
           });
       }

       function reloadTodoTable() {
           todoTable.ajax.url("/api/tasks").load();
       }

    </script>
@endsection
