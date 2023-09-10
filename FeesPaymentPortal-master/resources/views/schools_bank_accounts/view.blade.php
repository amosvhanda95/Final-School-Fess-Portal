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
                                <label for="exampleInputEmail1">School Name: {{ $school->school_name }} </label><br>
                                
                            <div class="form-group">
                                <p for="exampleInputEmail1">School Type: {{ $school->school_type }} </p>
                                <p for="exampleInputEmail1">School Email: {{ $school->email }} </p>
                                <p for="exampleInputEmail1">School Number: {{ $school->mobile_number }} </p>

                                <label for="exampleInputPassword1">Account Details</label>
                                @foreach ($school->bankAccounts as $bankAccount)
                                    <li>Account Number: {{ $bankAccount->account_number }}</li>
                                    <li>Account Currecy: {{ $bankAccount->currency }}</li>
                                    <li>Account Status: {{ $bankAccount->status == 1 ? 'Active' : 'Inactive' }}</li>
                                    
                                    <!-- Add more fields as needed -->
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="/bank_account" type="buttton" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
