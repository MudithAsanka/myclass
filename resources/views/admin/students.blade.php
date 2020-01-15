@extends('layouts.admin')

@section('title') Students @endsection

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                <strong>Students</strong>
            </div>
            <div class="card-header bg-light">
                <a href="{{ route('adminNewStudent') }}" class="btn btn-primary">Add Student</a>
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
                            <th>Teachers</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{!! nl2br($student->address) !!}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->contact_no }}</td>
                                <td>
                                    @foreach($classlists as $classlist)
                                            @if($classlist->student_id == $student->id)
                                                {{ $classlist->teacher_id }}
                                            @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('adminEditStudent', $student->id) }}" class="btn btn-warning"><i class="icon-pencil"></i></a>

                                    <form style="display: none;" method="POST" id="deleteStudent-{{ $student->id }}" action="{{ route('adminDeleteStudent', $student->id) }}">@csrf</form>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteStudentModal-{{ $student->id }}"><i class="icon-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($students as $student)
        <!-- Modal -->
        <div class="modal fade" id="deleteStudentModal-{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">You are about to delete {{ $student->name }}</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure?
                    </div>
                    <div class="modal-footer">

                        <form method="POST" id="deleteStudent-{{ $student->id }}" action="{{ route('adminDeleteStudent', $student->id) }}">
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
