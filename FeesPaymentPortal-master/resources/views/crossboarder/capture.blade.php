@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Beneficiaries List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Payments</a>
                        </li>
                        <li class="breadcrumb-item active">Beneficiaries</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card card-cyan">
                        <div class="card-header" style="height: 200px">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Second Name </th>
                                        <th>Phone Number</th>
                                        <th>ID Number</th>
                                        <th>House Number</th>
                                        <th>Surbub Area </th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $customer->first_name }}</td>
                                        <td>{{ $customer->surname }}</td>
                                        <td><b>{{ $customer->phone_number }}</b></td>

                                        <td>
                                            {{ $customer->id_number }}
                                        </td>
                                        <td>
                                            {{ $customer->house_number }}
                                        </td>
                                        <td>
                                            {{ $customer->area }}
                                        </td>
                                       
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                       
                        <form method="post" action="/crossboarder/proceed" class="mt-6 space-y-6">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3>   Beneficiaries List</h3>
                                                </div>
                                               
                                                        
                                                            <table id="example2" class="table table-bordered table-hover">
                                                                <thead>
                                                                <tr>
                                                                   
                                                                    <th>#</th>
                                                                    <th>Full Name</th>
                                                                    <th>Phone Number</th>
                                                                    <th>Country</th>
                                                                    <th>Currency</th>
                                                                    <th>FX-Rate</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @if(!empty($beneficiary) && $beneficiary->count())
                                                                    @foreach($beneficiary as $key => $value)
                                                                        <tr>
                                                                            <td>  {{ ($beneficiary->currentpage()-1) * $beneficiary->perpage() + $key + 1 }}
                                                                            </td>
                                                                            <td>{{ $value->rec_first_name }} {{ $value->rec_surname }}</td>
                                                                            <td>{{ $value->recipient_account_uri }}</td>
                                                                            <td>{{ $value->fxrate->country}}</td>
                                                                            <td>{{ $value->fxrate->currency}}</td>
                                                                            <td>{{ $value->fxrate->rate}}</td>
                                                                            
                                                                            <td class="project-actions text-center">
                                                                                <a class="btn btn-primary btn-sm" href="/beneficiaries/{{$value->id}}}">
                                                                                    <i class="fas fas-folder"></i>
                                                                                    View
                                                                                </a>
                                                                                
                                                                                <a class="btn btn-info btn-sm" href="/beneficiaries/{{$value->id}}}/edit">
                                                                                    <i class="fas fas-pencil-alt"></i>
                                                                                    Edit
                                                                                </a>
                                                                                
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="10">There are no data.</td>
                                                                    </tr>
                                                                @endif
                                                                </tbody>
                                                            </table>
                                                            {!! $beneficiary->links('pagination::bootstrap-4') !!}
                                                        
                                                         
                                                
                                                    
                                                <div class="card-body">
                                                    
                                                        
                                                        <!-- beneficiaries/index.blade.php -->

                                                        

                                                        

                                                            <div class="form-group">

                                                                <input type="hidden" name="user_id" class="form-control"
                                                                    value="{{ $id }}" required>
                                                                @error('phone_number')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            
                                                      
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4 mb-3 px-2">
                                                                <div class="form-group">
                                                                    <label for="benficiary_id">{{ __('Select Beneficiary') }}</label>
                                                                    <select id="benficiary_id" class="form-control @error('benficiary_id') is-invalid @enderror" name="customer_id" required>
                                                                        @foreach ($beneficiary as $sender)
                                                                            <option value="{{ $sender->id }}">{{ $sender->rec_first_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                        
                                                                    @error('benficiary_id')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mb-3 px-2">
                                                                <div class="form-group">
                                                                    <label class="control-label required">{{ __('Amount To Send') }}</label>
                                                                    <input type="text" name="amount" class="form-control" placeholder="23.00" value="{{ old('amount') }}" required>
                                                                    @error('amount')
                                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                   
                                                <div class="form-group">
                                                    <button id="searchAccountBtn" class="btn btn-success btn-block"
                                                        type="submit">Proceed</button>
                                                </div>
                                                    
                                                    <div class="form-group">
                                                        <a href="/crossboarder/index" class="btn btn-danger btn-block"
                                                            type="button">Go Back</a>
                                                    
                                                </div>
                                            </div>
                                  
                                            
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
