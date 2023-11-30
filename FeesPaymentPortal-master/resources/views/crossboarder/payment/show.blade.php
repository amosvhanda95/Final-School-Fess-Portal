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
                        
                        <pre>{{ print_r($sendmoney, true) }}</pre>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">transaction_reference</label>
                                    <input readonly type="text" value="{{$sendmoney->transaction_reference}}" name="transaction_reference" required class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">status</label>
                                    <input readonly type="text" value="{{$sendmoney->status}}" name="status"required class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">principal_amount</label>
                                    <input readonly type="text" value="{{$sendmoney->principal_amount}}" name="principal_amount"required class="form-control"  >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">sender_account_uri</label>
                                    <input readonly type="email" value="{{$sendmoney->sender_account_uri}}"class="form-control"required id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">recipient_account_uri</label>
                                    <input readonly name="rec_surname" class="form-control" required
                                       {{ $sendmoney->recipient_account_uri}}>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">fx_rate</label>
                                    <input readonly type="email" value="{{$sendmoney->fx_rate}}"class="form-control"required id="exampleInputEmail1" >
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
