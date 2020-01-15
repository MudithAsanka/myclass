@extends('layouts.student')

@section('title')
    New Payment
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <strong>New Payments</strong>
                    </div>
                    <div class="card-header">
                        <div class="alert alert-info text-center"><strong>{{ $time }}</strong></div>
                    </div>
                    <div class="card-body">
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Teacher Name</th>
                                            <th>Class fees</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($teachersDetails as $teacherDetails)
                                                <tr>
                                                    <td>{{ $teacherDetails->subject }}</td>
                                                    <td>{{ $teacherDetails->name }}</td>
                                                    <td>{{ $teacherDetails->class_fees }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="card-body">
                            <div class="alert alert-warning text-center col-md-4"><strong>Total Amount     Rs.{{ $totalAmount }}</strong></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
