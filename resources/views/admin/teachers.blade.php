@extends('layouts.admin')

@section('title') Teachers @endsection

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                <strong>Teachers</strong>
            </div>
            <div class="card-header bg-light">
                <a href="{{ route('adminNewTeacher') }}" class="btn btn-primary">Add Teacher</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>E-mail</th>
                            <th>Contact No</th>
                            <th>Subject</th>
                            <th>Class Fees</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teachers as $teacher)
                            <tr>
                                <td>{{ $teacher->id }}</td>
                                <td>{{ $teacher->name }}</td>
                                <td>{!! nl2br($teacher->address) !!}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->contact_no }}</td>
                                <td>{{ $teacher->subject }}</td>
                                <td>{{ $teacher->class_fees }}</td>
                                <td>
                                    <a href="{{ route('adminEditTeacher', $teacher->id) }}" class="btn btn-warning"><i class="icon-pencil"></i></a>

                                    <form style="display: none;" method="POST" id="deleteTeacher-{{ $teacher->id }}" action="{{ route('adminDeleteTeacher', $teacher->id) }}">@csrf</form>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteTeacherModal-{{ $teacher->id }}"><i class="icon-trash"></i></button>

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($teachers as $teacher)
         <!-- Modal -->
        <div class="modal fade" id="deleteTeacherModal-{{ $teacher->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">You are about to delete {{ $teacher->name }}</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure?
                    </div>
                    <div class="modal-footer">

                        <form method="POST" id="deleteTeacher-{{ $teacher->id }}" action="{{ route('adminDeleteTeacher', $teacher->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Yes, delete it</button>
                        </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No, keep it</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
