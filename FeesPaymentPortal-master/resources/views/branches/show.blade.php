@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Branch</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">School Section</a>
                        </li>
                        <li class="breadcrumb-item active">View Branch Details</li>
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
                            <h3 class="card-title">Branch Details</h3>
                        </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Branch Name</label>
                                    <input readonly type="text" value="{{$branch->branch_name}}" name="branch_name" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Branch Name</label>
                                    <input readonly type="text" value="{{$branch->email}}" name="email" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Branch Number</label>
                                    <input readonly type="text" value="{{$branch->mobile_number}}" name="mobile_number" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Address</label>
                                    <textarea name="branch_address" class="form-control" readonly>
                                       {{ $branch->branch_address}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="/branch" type="buttton" class="btn btn-primary">Back</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
