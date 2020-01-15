@extends('layouts.student')

@section('title') Payments @endsection

@section('content')
    <div class="content">
        <div class="card">
            <!--
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
            -->
            <div class="card-header bg-light">
                <strong>Payments</strong>
            </div>

            <form action="/student/payments_view" method="POST">
                @csrf

            <div class="card-header bg-light">
                <div class="row">
                    <div class="form-group col-md-4">
                        <select class="custom-select" id="single-select" name="time" required>
                            @foreach($months as $month)
                                <option value="{{ $month }}" @if($endmonth == $month) selected @endif>{{ $month }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <input class="btn btn-primary" type="submit" value="View Payments">
                <!--<a href="{ route('studentPaymentMonthFilter') }}" class="btn btn-primary" type="submit">View Payments</a>-->
            </div>
            <!--</form> -->


            @if($classlists != null)
                   <!-- <form action="/student/payments/new" method="POST"> @csrf-->

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Teacher Name</th>
                            <th>Class fees</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($classlists as $classlist)
                            <tr>
                                <td>{{ $classlist->subject }}</td>
                                <td>{{ $classlist->name }}</td>
                                <td>{{ $classlist->class_fees }}</td>
                                <td>
                                    @if( $paymentsDetails == null)
                                        Already Paid
                                    @else
                                        <div class="toggle-switch" data-ts-color="primary">
                                            <input id="{{ $classlist->name }}" type="checkbox" hidden="hidden" value="{{ $classlist->id }}" name="teacherarray[]">
                                            <label for="{{ $classlist->name }}" class="ts-helper" ></label>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                        <div class="card-body" align="center">
                            <button class="btn btn-success col-md-4" type="submit"><strong>Pay</strong></button>
                        </div>

            @endif
            </form>
        </div>
    </div>
@endsection
