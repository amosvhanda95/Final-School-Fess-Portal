@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Beneficiary</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Beneficiary Section</a>
                        </li>
                        <li class="breadcrumb-item active">Create Beneficiary</li>
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
                            <h3 class="card-title">Fill in the Form Below To Create Customer</h3>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('beneficiaries.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="customer_id">{{ __('Select Sender') }}</label>
                                    <select id="customer_id" class="form-control @error('customer_id') is-invalid @enderror" name="customer_id" required>
                                        @foreach ($senders as $sender)
                                            <option value="{{ $sender->id }}">{{ $sender->first_name }} {{ $sender->surname }}  {{ $sender->id_number}}</option>
                                        @endforeach
                                    </select>
        
                                    @error('customer_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Phone Number') }}</label>
                                    <input type="text" name="recipient_account_uri" class="form-control"
                                        placeholder="26377" value="{{ old('recipient_account_uri') }}" required>
                                    @error('recipient_account_uri')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Beneficiary Name') }}</label>
                                    <input type="text" name="rec_first_name" class="form-control"
                                        placeholder="Enter First Name" value="{{ old('rec_first_name') }}" required>
                                    @error('school_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                               
                                
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Beneficiary Surname') }}</label>
                                    <input type="text" name="rec_surname" class="form-control"
                                        placeholder="Enter Surname" value="{{ old('rec_surname') }}" required>
                                    @error('rec_surname')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">{{ __('House Number') }}</label>
                                    <input type="text" name="rec_house_number" class="form-control"
                                        placeholder="Enter House Number" value="{{ old('rec_house_number') }}" required>
                                    @error('rec_house_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Area') }}</label>
                                    <input type="text" name="rec_area" class="form-control"
                                        placeholder="Enter Area" value="{{ old('rec_area') }}" required>
                                    @error('rec_area')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                               <div class="form-group">
                                    <label class="control-label required">{{ __('City') }}</label>
                                    <input type="text" name="rec_city" class="form-control"
                                        placeholder="Enter City" value="{{ old('rec_city') }}" required>
                                    @error('rec_city')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                               

                                    <div class="form-group">
                                        <label for="country_id">{{ __('Select Country') }}</label>
                                        <select id="country_id" class="form-control @error('country_id') is-invalid @enderror" name="country_id" required>
                                            @foreach ($fxRates as  $fxRate)
                                                <option value="{{ $fxRate->id }}">{{ $fxRate->country }} - {{ $fxRate->rate }}</option>
                                            @endforeach
                                        </select>
            
                                        @error('customer_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Create Beneficiary</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
