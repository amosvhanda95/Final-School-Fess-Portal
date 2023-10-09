@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Beneficiary</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Beneficiary Section</a>
                        </li>
                        <li class="breadcrumb-item active">Update Beneficiary</li>
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
                            <h3 class="card-title">Update Fields in the Form Below</h3>
                        </div>
                        <form method="post" action="/edit_beneficiary/{{ $beneficiary->id }}/edit">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="control-label required">{{ __('Phone Number') }}</label>
                                        <input  type="text" name="recipient_account_uri" class="form-control"
                                            placeholder="Enter City" value="{{ $beneficiary ->recipient_account_uri }}" required>
                                        @error('recipient_account_uri')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <label class="control-label required">{{ __('First Name') }}</label>
                                    <input  type="text" name="first_name" class="form-control"
                                        placeholder="Enter First Name" value="{{ $beneficiary ->rec_first_name }}" required>
                                    @error('school_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Surname') }}</label>
                                    <input  type="text" name="surname" class="form-control"
                                        placeholder="Enter Surname" value="{{ $beneficiary ->rec_surname}}" required>
                                    @error('surname')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                             
                                <div class="form-group">
                                    <label class="control-label required">{{ __('House Number') }}</label>
                                    <input  type="text" name="rec_house_number" class="form-control"
                                        placeholder="1090 Mukwana Ave" value="{{ $beneficiary ->rec_house_number }}" required>
                                    @error('rec_house_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Area') }}</label>
                                    <input  type="text" name="rec_area" class="form-control"
                                        placeholder="Enter Area" value="{{ $beneficiary ->rec_area }}" required>
                                    @error('rec_area')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                    
                                <div class="form-group">
                                    <label class="control-label required">{{ __('City') }}</label>
                                    <input  type="text" name="rec_city" class="form-control"
                                        placeholder="Enter City" value="{{ $beneficiary ->rec_city }}" required>
                                    @error('rec_city')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="country_id">{{ __('Select Country') }}</label>
                                    <select id="country_id" class="form-control @error('country_id') is-invalid @enderror" name="country_id" required>
                                        @foreach ($fxRates as  $fxRate)
                                            <option value="{{ $fxRate->id }}">- {{ $fxRate->country }}</option>
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
                                <button type="submit" class="btn btn-primary">Update Beneficiary</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
