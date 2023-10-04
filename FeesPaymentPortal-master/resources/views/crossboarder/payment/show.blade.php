@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Show CrossBoader Payment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">CrossBoader Section</a>
                        </li>
                        <li class="breadcrumb-item active">Show CrossBoader</li>
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
                            <h3 class="card-title">View Fields in the Form Below</h3>
                        </div>
                        
                       
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Transaction_Reference</label>
                                    <input readonly type="text" value="{{$sendmoney->transaction_reference}}" name="transaction_reference" required class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status</label>
                                    <input readonly type="text" value="{{$sendmoney->status}}" name="status"required class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">id_from_API</label>
                                    <input readonly type="text" value="{{$sendmoney->id_from_API}}" name="id_from_API"required class="form-control"  >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">rec_first_name</label>
                                    <input readonly type="email" value="{{$sendmoney->rec_first_name}}"class="form-control"required id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Address</label>
                                    <textarea readonly name="rec_surname" class="form-control" required>
                                       {{ $sendmoney->rec_surname}}
                                    </textarea>
                                </div>
                                
                            </div>
                            <div class="card-footer">
                                <a href="/crossboader-payment" type="buttton" class="btn btn-primary">Back</a>
                            </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
