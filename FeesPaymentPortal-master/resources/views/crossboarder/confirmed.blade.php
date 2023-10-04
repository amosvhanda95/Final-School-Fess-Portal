@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quotation Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Payments</a>
                        </li>
                        <li class="breadcrumb-item active">Quotation Details</li>
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
                    <div class="card card-cyan">
                        {{-- <div class="alert alert-info">
                            <h1 class="display-4">Payment Details</h1>
                            <h2 class="h4"><strong>Transaction Reference:</strong> {{ $jsonData['quote']['transaction_reference'] }}</h2>
                            <h2 class="h4"><strong>Payment Type:</strong> {{ $jsonData['quote']['payment_type'] }}</h2>
                        </div> --}}
                        

                        
                        <div class="card-header" style="height: auto">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Resource Type</th>
                                        <th>Master Charge </th>
                                        <th>Total Charged</th>
                                        <th>Credited Amount</th>
                                        <th>Principal Amount</th>
                                        <th>Bank Charge</th>
                                        <th>RBZ Charge</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jsonData['quote']['proposals']['proposal'] as $proposal)
                                        <tr>
                                            <td>{{ $proposal['id'] }}</td>
                                            <td>{{ $proposal['resource_type'] }}</td>
                                           
                                            <td>{{ $proposal['charged_amount']['amount']  }} {{ $proposal['charged_amount']['currency'] }}</td>
                                            <td>{{ $proposal['charged_amount']['amount'] + $proposal['principal_amount']['amount'] * 0.05 + $proposal['principal_amount']['amount'] * 0.01}} {{ $proposal['charged_amount']['currency'] }}</td>
                                            <td>{{ $proposal['credited_amount']['amount'] }} {{ $proposal['credited_amount']['currency'] }}</td>
                                            <td>{{ $proposal['principal_amount']['amount'] }} {{ $proposal['principal_amount']['currency'] }}</td>
                                            <td>{{ $proposal['principal_amount']['amount'] * 0.05 }} {{ $proposal['principal_amount']['currency'] }}</td>
                                            <td>{{ $proposal['principal_amount']['amount'] * 0.01 }} {{ $proposal['principal_amount']['currency'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3>Please Fill in  Receiver Details</h3>
                            </div>
                            <div class="card-body">

                      
                       

                                <form method="post" action="/crossboarder/payment">
                                    @csrf
                                    <input type="hidden" name="json_data" id="json_data" value="{{ json_encode($jsonData) }}">
                                    <input type="hidden" name="id" value="{{ $jsonData['quote']['proposals']['proposal'][0]['id'] }}">
                                    <input type="hidden" name="transaction_reference" value="{{ $jsonData['quote']['transaction_reference'] }}">
                                    <input type="hidden" name="user_id" value="{{ $id }}">
                                    <input type="hidden" name="rec_phone_number" value="{{ $receiverPhone }}">
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
                                            type="submit">Make Payment</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>            
 @endsection