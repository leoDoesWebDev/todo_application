@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Todo List</div>
            <div class="card-body">

            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        console.log('JS yield working')

        $(function (e){
            console.log('jquery  working');
        })
    </script>
@endsection
