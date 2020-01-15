@extends('layouts.admin')

@section('title') Edit Student @endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            <strong>Edit Student</strong>
                        </div>
                        <div class="card-header">
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert-success">{{ Session('success') }}</div>
                            @endif
                            @if($errors->any())
                                <div class="alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <form action="{{ route('adminEditStudent', $student->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Student ID</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                </div>
                                                <input id="studentId" class="form-control" value="{{ $student->id }}" readonly>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Name</label>
                                            <input name="name" id="normal-input" class="form-control" value="{{ $student->name }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="placeholder-input" class="form-control-label">Address</label>
                                            <textarea class="form-control" name="address" id="" cols="30" rows="6">{{ $student->address }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">E-mail</label>
                                            <input name="email" id="normal-input" class="form-control" value="{{ $student->email }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Contact No</label>
                                            <input name="contact_no" id="normal-input" class="form-control" value="{{ $student->contact_no }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Classes</label>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Subject</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($teachers as $teacher)
                                                        <tr>
                                                            <td>{{ $teacher->name }}</td>
                                                            <td>{{ $teacher->subject }}</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="toggle-switch" data-ts-color="primary">
                                                                            <input id="{{ $teacher->name }}" type="checkbox" hidden="hidden" value="{{ $teacher->id }}" name="teacherarray[]" @foreach($teachers_id as $teacher_id) @if(($teacher->id) == $teacher_id) checked @endif @endforeach>
                                                                            <label for="{{ $teacher->name }}" class="ts-helper"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Update Student</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
