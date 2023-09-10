@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update  Bank Account</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">BAnk Section</a>
                        </li>
                        <li class="breadcrumb-item active">Update  Bank Account</li>
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
                            <h3 class="card-title">Fill in the Form Below To Upate School Bank Account</h3>
                        </div>
                        @if ($errors->any()) <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach </ul>
                        </div>
                        @endif
                        <form method="post" action="/bank_account/{{$account->id}}/edit">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="branch" >Select School</label>
                                    <select name="school_id" class="form-control" required>
                                        <option>Select School</option>
                                        @foreach(\App\Models\School::where('status', 1)->get() as $school)
                                            <option value="{{$school->id}}">{{$school->school_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Account Number') }}</label>
                                    <input type="number" value="{{$account->account_number}}"  name="account_number" class="form-control" id="exampleInputEmail1" placeholder="50000...">
                                </div>

                                <div class="form-group">
                                    <label for="currency" required>Currency</label>
                                    <select name="currency" class="form-control" required>
                                        <option value="">Choose Currency</option>
                                        <option value="ZWL">ZWL</option>
                                        <option value="USD">USD</option>
                                    </select>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="branch" required>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1">Active</option>
                                        <option value="0">Disable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
