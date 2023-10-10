@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Beneficiary</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Beneficiary Section</a>
                        </li>
                        <li class="breadcrumb-item active">View Beneficiary Details</li>
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
                            <h3 class="card-title">Beneficiary Details</h3>
                        </div>
                      
                       
        <div class="card-body">
            <div class="form-group">
                <label class="control-label required">{{ __('First Name') }}</label>
                <input readonly type="text" name="rec_first_name" class="form-control"
                    placeholder="Enter First Name" value="{{ $beneficiary ->rec_first_name }}" required>
                @error('school_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="control-label required">{{ __('Surname') }}</label>
                <input readonly type="text" name="surname" class="form-control"
                    placeholder="Enter Surname" value="{{ $beneficiary ->rec_surname}}" required>
                @error('surname')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
           
          
            <div class="form-group">
                <label class="control-label required">{{ __('House Number') }}</label>
                <input readonly type="text" name="house_number" class="form-control"
                    placeholder="1090 Mukwana Ave" value="{{ $beneficiary ->rec_house_number }}" required>
                @error('house_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="control-label required">{{ __('Area') }}</label>
                <input readonly type="text" name="area" class="form-control"
                    placeholder="Enter Area" value="{{ $beneficiary ->rec_area }}" required>
                @error('area')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="control-label required">{{ __('City') }}</label>
                <input readonly type="text" name="city" class="form-control"
                    placeholder="Enter City" value="{{ $beneficiary ->rec_city }}" required>
                @error('city')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="control-label required">{{ __('County') }}</label>
                <input readonly type="text" name="rec_city" class="form-control"
                    placeholder="Enter City" value="{{ $beneficiary ->fxrate->country}}" required>
                @error('city')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="control-label required">{{ __('Linked Customer') }}</label>
                <input readonly type="text" name="customer_name" class="form-control"
                    placeholder="" value="{{ $beneficiary ->customer->first_name }} {{ $beneficiary ->customer->surname}} {{ $beneficiary ->customer->id_number}}  " required>
                @error('house_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
        </div>
                            <div class="card-footer">
                                <a href="/beneficiary" type="buttton" class="btn btn-primary">Back</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
