@extends('layouts.member.app')

@section('content')
@if($error)
<div class="alert alert-dismissible animate fade show bg-danger bg-darken-sm shadow-lg shadow-danger text-white rounded-pill"
    role="alert">
    {{ $msg }}
</div>
@endif
<info-bar-top-component :head="'Actual task to complete -> Task {{ $actualTask->id }}'" subhead="Please complete this task" :btn="true" btn-text="Complete Now" btn-link="/member/complete/task/{{ $actualTask->id }}"></info-bar-top-component>
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">My Tasks</h4>
                {!! $tasks->withQueryString()->links('pagination::bootstrap-5') !!}
                <div class="table-responsive mb-3">
                    <table class="table text-white">
                        <thead>
                            <tr>
                                <th> Task Number </th>
                                <th> Task Status </th>
                                <th> Completed At</th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr>
                                <td>
                                    <span class="ps-2">Task {{$task->task_number}}</span>
                                </td>
                                <td> @if($task->task_status) <div class="badge badge-outline-success">Completed</div> @else <div
                                        class="badge badge-outline-warning">Pending</div> @endif </td>
                                <td>
                                    @if($task->task_status)
                                    {{ $task->updated_at }}
                                    @else
                                    Not completed yet
                                    @endif</td>
                                <td>
                                    @if(!$task->task_status)
                                    <a href="/member/complete/task/{{ $task->id }}" class="btn btn-info col-12 mx-auto"> <i class="mdi mdi-rocket"></i> Complete
                                        Now</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $tasks->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>
@endsection