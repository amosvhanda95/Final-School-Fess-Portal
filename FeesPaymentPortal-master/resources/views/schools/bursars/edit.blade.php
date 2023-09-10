@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Bursar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Bursar Section</a>
                        </li>
                        <li class="breadcrumb-item active">Update Bursar</li>
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
                            <h3 class="card-title">Fill in the Form Below</h3>
                        </div>
                        <form method="post" action="/bursars/{{ $bursar->id }}/edit">
                            
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Full Name') }}</label>
                                    <input type="text"  value="{{$bursar->full_name}}"  name="full_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Full name">
                                </div>

                                    <div class="form-group">
                                        <label class="control-label required">{{ __('Mobile Number') }}</label>
                                        <input type="text" value="{{$bursar->mobile_number}}" name="mobile_number" class="form-control" id="exampleInputEmail1" placeholder="2637...">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">School Name</label>
                                        <input readonly type="text" value="{{$bursar->school->school_name}}" name="text" class="form-control" id="exampleInputEmail1" >
                                    </div>
                                    

                                
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Bursar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
