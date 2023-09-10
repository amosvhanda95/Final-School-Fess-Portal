@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Capture Payment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Payments</a>
                        </li>
                        <li class="breadcrumb-item active">Capture Payment</li>
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
                            <h3 class="card-title">Please Enter the Bank Account Number $ Reg Number</h3>
                        </div>
                        @if ($errors->any()) <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach </ul>
                        </div>
                        @endif
                        <form method="post" action="/payment/id_account_search">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Bank Account Number') }}</label>
                                    <input type="number"  name="account_number" class="form-control" id="account_number" placeholder="Enter bank account number">
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Reg Number') }}</label>
                                    <input type="text"  name="reg_number" class="form-control" id="reg_number" placeholder="R158678T">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <button id="searchAccountBtn" class="btn btn-primary btn-block" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

