@extends('layouts.admin.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tasks List</h4>
                    {!! $tasks->withQueryString()->links('pagination::bootstrap-5') !!}
                    <div class="table-responsive mb-4">
                        <table class="table text-white">
                            <thead>
                                <tr>
                                    <th> Member </th>
                                    <th> Task Number </th>
                                    <th> Task Cost </th>
                                    <th> Task Status </th>
                                    <th> Updated At</th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                <tr>
                                    <td> {{$task->member->user->username}} : ${{$task->member->user->member->balance}} </td>
                                    <td>
                                        <span class="ps-2">Task {{$task->task_number}}</span>
                                    </td>
                                    <td> {{$task->task_cost}} $</td>
                                    <td> @if($task->task_status) <div class="badge badge-outline-success">Completed</div> @else <div class="badge badge-outline-warning">Pending</div> @endif </td>
                                    <td>{{ $task->updated_at }}</td>
                                    <td>
                                                <a href="#" class="btn btn-primary btn-sm col-12" data-bs-toggle="modal" data-bs-target="#showModal{{ $task->id }}"> <i class="mdi mdi-pencil"></i> Edit</a>
                                        <div class="modal fade" id="showModal{{ $task->id }}" tabindex="-1"
                                            aria-labelledby="showModal" aria-hidden="true" data-tor-parent="show">
                                            <div class="modal-dialog modal-dialog-centered no-transform">
                                                <div class="modal-content bg-white" data-tor="show(p):reveal(up)">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-primary" id="exampleModalPromoLabel5">{{ $task->member->user->username }}</h5> <span class="text-muted"> Task {{ $task->id }}</span>
                                                        <button ref="closeModal" type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.update', ["task", $task->id ]) }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="number" name="cost" class="form-control text-white mb-3" placeholder="Task Cost"
                                                                value="{{ $task->task_cost }}">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn mb-2 btn-dark" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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