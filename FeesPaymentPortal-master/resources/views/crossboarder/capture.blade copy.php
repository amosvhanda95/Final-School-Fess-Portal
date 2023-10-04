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
                                                    <h3>Please Fill in  Receiver Details</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            
                                                            <input type="hidden" name="first_name" class="form-control"
                                                                placeholder="Enter First Name" value="{{  $customer->first_name }}" required>
                                                            @error('school_name')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            
                                                            <input type="hidden" name="surname" class="form-control"
                                                                placeholder="Enter Surname" value="{{ $customer->surname  }}" required>
                                                            @error('surname')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" name="id_number" class="form-control"
                                                                placeholder="Enter ID Number" value="{{$customer->id_number}}" required>
                                                            @error('id_number')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" name="date_of_birth" class="form-control"
                                                                placeholder="Enter Date Of Birth" value="{{$customer->date_of_birth }}" required>
                                                            @error('date_of_birth')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" name="phone_number" class="form-control"
                                                                placeholder="263775021912" value="{{ $customer->phone_number}}" required>
                                                            @error('phone_number')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                      
                                                        <div class="form-group">
                                                            
                                                            <input type="hidden" name="house_number" class="form-control"
                                                                placeholder="1090 Mukwana Ave" value="{{ $customer->house_number }}" required>
                                                            @error('house_number')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" name="area" class="form-control"
                                                                placeholder="Enter Area" value="{{ $customer->area }}" required>
                                                            @error('area')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                        
                                                        <div class="form-group">
                                                            <input type="hidden"  name="city" class="form-control"
                                                                placeholder="Enter City" value="{{  $customer->city  }}" required>
                                                            @error('city')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        
                                                    </div>
                                                {{-- Viewed --}}
                                                    <div class="form-group">
                                                        <label class="control-label required">{{ __('Enter Amount') }}</label>
                                                        <input type="text" name="rec_amount" class="form-control"
                                                            placeholder="20.00" value="{{ old('rec_amount') }}" required>
                                                        @error('rec_amount')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label required">{{ __('First Name') }}</label>
                                                        <input type="text" name="rec_first_name" class="form-control"
                                                            placeholder="Enter First Name" value="{{ old('rec_first_name') }}" required>
                                                        @error('rec_first_name')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="control-label required">{{ __('Surname') }}</label>
                                                        <input type="text" name="rec_surname" class="form-control"
                                                            placeholder="Enter Surname" value="{{ old('rec_surname') }}" required>
                                                        @error('rec_surname')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                   
                                                  
                                                    <div class="form-group">
                                                        <label class="control-label required">{{ __('Phone Number') }}</label>
                                                        <input type="number" name="rec_phone_number" class="form-control"
                                                            placeholder="263775021912" value="{{ old('rec_phone_number') }}" required>
                                                        @error('rec_phone_number')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                  
                                                    <div class="form-group">
                                                        <label class="control-label required">{{ __('House Number') }}</label>
                                                        <input type="text" name="rec_house_number" class="form-control"
                                                            placeholder="1090 Mukwana Ave" value="{{ old('rec_house_number') }}" required>
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
                                                        <label class="control-label required">{{ __('Country') }}</label>
                                                        <select name="country" class="form-control" required>
                                                            <option value="">Select a country</option>
                                                            <option value="ZWE">Zimbabwe</option>
                                                            <option value="ZAF">South Africa </option>
                                                            <option value="GBR">United Kingdom of Great Britain </option>
                                                            <option value="USA">United States of America </option>
                                                            <!-- Add more options for additional countries -->
                                                        </select>
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
