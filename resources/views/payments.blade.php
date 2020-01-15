@extends('layouts.master')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{ asset('assets/img/home-bg.jpg') }}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Payments</h1>
                        <span class="subheading">Do you want to pay class fees?</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="input-group">
                        <input type="text" id="input-group-2" name="input1-group2" class="form-control" placeholder="Student ID">
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                        </span>
                    </div>
            </div>
        </div>
    </div>

@endsection
