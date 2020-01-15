@extends('layouts.admin')

@section('title') Edit Teacher @endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            <strong>Edit Teacher</strong>
                        </div>
                        <div class="card-header">
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if(Session('success'))
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

                        <form action="{{ route('adminEditTeacher', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Teacher ID</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                </div>
                                                <input id="teacherId" class="form-control" value="{{ $teacher->id }}" readonly>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Name</label>
                                            <input name="name" id="normal-input" class="form-control" value="{{ $teacher->name }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="placeholder-input" class="form-control-label">Address</label>
                                            <textarea class="form-control" name="address" id="" cols="30" placeholder="Address" rows="6">{{ $teacher->address }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">E-mail</label>
                                            <input name="email" id="normal-input" class="form-control" value="{{ $teacher->email }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Contact No</label>
                                            <input name="contact_no" id="normal-input" class="form-control" value="{{ $teacher->contact_no }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Subject</label>
                                            <input name="subject" id="normal-input" class="form-control" value="{{ $teacher->subject }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Class Fees</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rs.</span>
                                                </div>
                                                <input type="text" class="form-control" name="class_fees" value="{{ $teacher->class_fees }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary" type="submit">Update Teacher</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
