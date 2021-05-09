@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Todo List</div>
            <div class="card-body">
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
@endsection
@section('javascript')
    <script>
        console.log('JS yield working')

        $(function (e){
            console.log('jquery  working');
            

            let todoTable = $('#todo_table').DataTable({
                "ajax": {
                    "url": "/api/items",
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
        })
    </script>
@endsection
