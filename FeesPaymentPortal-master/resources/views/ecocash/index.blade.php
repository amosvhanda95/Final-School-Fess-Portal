@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Link To Eco Cash</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Clients Section</a>
                        </li>
                        <li class="breadcrumb-item active">Link To Eco Cash</li>
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
                    <div class="card-body">
                        <h3>Link To Eco Cash</h3>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Fill in To Link To Eco Cash</h3>
                            </div>
                            <form method="post" action="/register-to-eco-cash">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="control-label required">{{ __('Service Type') }}</label>
                                        <input type="text" name="serviceType" class="form-control" id="serviceType"
                                               placeholder="Enter service type" value="BANKREG" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label required">{{ __('External Reference') }}</label>
                                        <input type="text" name="externalReference" class="form-control" id="externalReference"
                                               placeholder="Enter external reference" value="169865633" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label required">{{ __('Bank ID') }}</label>
                                        <input type="text" name="bankId" class="form-control" id="bankId"
                                               placeholder="Enter bank ID" value="IND0410171" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label required">{{ __('Bank Account Number') }}</label>
                                        <input type="text" name="bankAccNumber" class="form-control" id="bankAccNumber"
                                               placeholder="Enter bank account number" value="775461117" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label required">{{ __('Mobile Number (MSISDN)') }}</label>
                                        <input type="text" name="msisdn" class="form-control" id="msisdn"
                                               placeholder="Enter mobile number" value="775461117" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label required">{{ __('Currency') }}</label>
                                        <input type="text" name="currency" class="form-control" id="currency"
                                               placeholder="Enter currency" value="ZWL" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label required">{{ __('First Name') }}</label>
                                        <input type="text" name="firstName" class="form-control" id="firstName"
                                               placeholder="Enter first name" value="Ropafadzo" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label required">{{ __('Last Name') }}</label>
                                        <input type="text" name="lastName" class="form-control" id="lastName"
                                               placeholder="Enter last name" value="Nyagwaya" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label required">{{ __('National ID') }}</label>
                                        <input type="text" name="nationalId" class="form-control" id="nationalId"
                                               placeholder="Enter national ID" value="775461117B12" required>
                                    </div>
                                    <!-- Add more fields for other parameters as needed -->

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Link To Eco Cash</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
