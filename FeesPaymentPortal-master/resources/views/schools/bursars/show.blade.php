@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Bursar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">School Section</a>
                        </li>
                        <li class="breadcrumb-item active">View Bursar Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Bursar Details</h3>
                        </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Bursar Full Name</label>
                                    <input readonly type="text" value="{{$bursar->full_name}}" name="branch_name" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">School Name</label>
                                    <input readonly type="text" value="{{$bursar->school->school_name}}" name="text" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile Number</label>
                                    <input readonly type="text" value="{{$bursar->mobile_number}}" name="mobile_number" class="form-control" id="exampleInputEmail1" >
                                </div>
                               
                            </div>
                            <div class="card-footer">
                                <a href="/bursars" type="buttton" class="btn btn-primary">Back</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
