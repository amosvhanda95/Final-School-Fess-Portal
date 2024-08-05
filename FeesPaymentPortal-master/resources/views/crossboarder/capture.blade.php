@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customer  : {{ $customer->first_name }} {{ $customer->surname }}</h1>
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
                        <div class="card-header">
                            <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Second Name</th>
                                            <th>Phone Number</th>
                                            <th>ID Number</th>
                                            <th>House Number</th>
                                            <th>Suburb Area</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $customer->first_name }}</td>
                                            <td>{{ $customer->surname }}</td>
                                            <td><b>{{ $customer->phone_number }}</b></td>
                                            <td>{{ $customer->id_number }}</td>
                                            <td>{{ $customer->house_number }}</td>
                                            <td>{{ $customer->area }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                       
                        <form method="post" action="/crossboarder/proceed" class="mt-6 space-y-6">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        
                                            <div class="card "  style="padding: 10px; margin: 20px;">
                                                <div class="card-header">
                                                    <h3>   Beneficiaries List</h3>
                                                </div>
                                               
                                                        
                                                <div class="table-responsive">
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
                                                                        <td>{{ ($beneficiary->currentpage()-1) * $beneficiary->perpage() + $key + 1 }}</td>
                                                                        <td>{{ $value->rec_first_name }} {{ $value->rec_surname }}</td>
                                                                        <td>{{ $value->recipient_account_uri }}</td>
                                                                        <td>{{ $value->fxrate->country}}</td>
                                                                        <td>{{ $value->fxrate->currency}}</td>
                                                                        <td>{{ $value->fxrate->rate}}</td>
                                                                        <td class="project-actions text-center">
                                                                            <div class="btn-group">
                                                                                <a class="btn btn-primary btn-sm" href="/beneficiary/{{$value->id}}">
                                                                                    <i class="fas fas-folder"></i>
                                                                                    View
                                                                                </a>
                                                                                <a class="btn btn-info btn-sm" href="/beneficiary/{{$value->id}}/edit">
                                                                                    <i class="fas fas-pencil-alt"></i>
                                                                                    Edit
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="7">There is no data.</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
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
                                                            <div class="col-md-3 mb-3 px-2">
                                                                <div class="form-group">
                                                                    <label for="benficiary_id">{{ __('Beneficiary') }}</label>
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
                                                        
                                                            <div class="col-md-3 mb-3 px-2">
                                                                <div class="form-group">
                                                                    <label class="control-label required">{{ __('Amount To Send') }}</label>
                                                                    <input type="number" name="amount" class="form-control" placeholder="23.00" value="{{ old('amount') }}" required max="5000">
                                                                    <!-- 'max' attribute is set to 4999.99 to ensure amounts are less than 5000 -->
                                                                    @error('amount')
                                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            
                                                        
                                                            <div class="col-md-3 mb-3 px-2">
                                                                <div class="form-group">
                                                                    <label for="source_of_income">{{ __('Source of Income') }}</label>
                                                                    <select id="source_of_income" class="form-control @error('source_of_income') is-invalid @enderror" name="source_of_income" required>
                                                                        <option disabled selected value="">Source of income</option>
                                                                        <option value="Business">Business</option>
                                                                        <option value="Government funding">Government funding</option>
                                                                        <option value="Investments">Investments</option>
                                                                        <option value="Loan">Loan</option>
                                                                        <option value="Personal Income">Personal Income</option>
                                                                        <option value="Salary">Salary</option>
                                                                        <option value="Savings">Savings</option>
                                                                       
                                                                    </select>
                                                                    @error('source_of_income')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="col-md-3 mb-3 px-2">
                                                                <div class="form-group">
                                                                    <label for="purpose_of_payment">{{ __('Purpose of Payment') }}</label>
                                                                    <select id="purpose_of_payment" class="form-control @error('purpose_of_payment') is-invalid @enderror" name="purpose_of_payment" required>
                                                                        <option disabled selected value="">Purpose of payment</option>
                                                                        <option value="Family Maintenance">Family Maintenance</option>
                                                                        <option value="Household Maintenance">Household Maintenance</option>
                                                                        <option value="Payment of Loan">Payment of Loan</option>
                                                                        <option value="Purchase of Property">Purchase of Property</option>
                                                                        <option value="Funeral Expenses">Funeral Expenses</option>
                                                                        <option value="Medical Expenses">Medical Expenses</option>
                                                                        <option value="Wedding Expenses">Wedding Expenses</option>
                                                                        <option value="Payment of bills">Payment of bills</option>
                                                                        <option value="Education">Education</option>
                                                                        <option value="Savings">Savings</option>
                                                                        <option value="Employee Colleague">Employee Colleague</option>
                                                                        <!-- Add other options as needed -->
                                                                    </select>
                                                                    @error('purpose_of_payment')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
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
