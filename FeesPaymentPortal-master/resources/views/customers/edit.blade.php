@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Customer Section</a>
                        </li>
                        <li class="breadcrumb-item active">Update Customer</li>
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
                        <form method="post" action="/edit_customer/{{ $customer->id }}/edit">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="control-label required">{{ __('First Name') }}</label>
                                    <input  type="text" name="first_name" class="form-control"
                                        placeholder="Enter First Name" value="{{ $customer ->first_name }}" required>
                                    @error('school_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Surname') }}</label>
                                    <input  type="text" name="surname" class="form-control"
                                        placeholder="Enter Surname" value="{{ $customer ->surname}}" required>
                                    @error('surname')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">{{ __('ID Number') }}</label>
                                    <input  type="text" name="id_number" class="form-control"
                                        placeholder="Enter ID Number" value="{{ $customer ->id_number }}" required>
                                    @error('id_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Date Of Birth') }}</label>
                                    <input  type="date" name="date_of_birth" class="form-control"
                                        placeholder="Enter Date Of Birth" value="{{ $customer ->date_of_birth}}" required>
                                    @error('date_of_birth')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Phone Number') }}</label>
                                    <input  type="number" name="phone_number" class="form-control"
                                        placeholder="263775021912" value="{{ $customer ->phone_number}}" required>
                                    @error('phone_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                              
                                <div class="form-group">
                                    <label class="control-label required">{{ __('House Number') }}</label>
                                    <input  type="text" name="house_number" class="form-control"
                                        placeholder="1090 Mukwana Ave" value="{{ $customer ->house_number }}" required>
                                    @error('house_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Area') }}</label>
                                    <input  type="text" name="area" class="form-control"
                                        placeholder="Enter Area" value="{{ $customer ->area }}" required>
                                    @error('area')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                    
                                <div class="form-group">
                                    <label class="control-label required">{{ __('City') }}</label>
                                    <input  type="text" name="city" class="form-control"
                                        placeholder="Enter City" value="{{ $customer ->city }}" required>
                                    @error('city')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="occupation">{{ __('Select Occupation') }}</label>
                                    <select id="occupation" class="form-control @error('occupation') is-invalid @enderror" name="occupation"  value="{{ $customer ->occupations }}"required>
                                        <option disabled selected value="">Please select an occupation</option> <!-- This is the unselectable option -->
                                        <option value="General Worker">General Worker</option>
                                        <option value="Businessman">Businessman</option>
                                        <option value="Professional">Professional</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Tourist">Tourist</option>
                                        <option value="Security Guard">Security Guard</option>
                                        <option value="House Maid">House Maid</option>
                                        <option value="Domestic Helper">Domestic Helper</option>
                                        <option value="House Wife">House Wife</option>
                                        <option value="Others">Others</option>
                                    </select>
                                
                                    @error('occupation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Customer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
