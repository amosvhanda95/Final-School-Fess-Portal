@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Golden-knot Capture  Payment</h1>
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
                        <div class="card-header">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Company Account #</th>
                                            <th>Currency</th>
                                            <th>Company Email</th>
                                            <th>Company Phonenumber</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $bankAccount->school->school_name }}</td>
                                            <td>{{ $bankAccount->account_number }}</td>
                                            <td><b>{{ $bankAccount->currency }}</b></td>
                                            <td>{{ $bankAccount->school->email }}</td>
                                            <td>{{ $bankAccount->school->mobile_number }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <form method="post" action="/payment/golden_knot-make_payment" id="quickForm">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3>Please Fill in the following fields</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="payment_method">Payment Method</label>
                                                    <select name="payment_method" id="payment_method" class="form-control" onchange="toggleRRNField()">
                                                        <option value="swipe">Swipe</option>
                                                        <option value="cash">Cash</option>
                                                    </select>
                                                </div>
                                                @if (auth()->check() && auth()->user()->type === 5)
                                                <div class="form-group">
                                                    <label for="currency">Currency</label>
                                                    <select name="currency" id="currency" class="form-control" onchange="toggleRRNField()">
                                                        <option value="ZiG">ZiG</option>
                                                        <option value="USD">USD</option>
                                                        <!-- Add more currency options as needed -->
                                                    </select>
                                                </div>
                                                @endif
                                                
                                                
                                                <div class="form-group"id="rrn_field">
                                                    <label for="amount">Enter RRN </label>
                                                    <input type="number" id="rrn_field1" placeholder="7879677"
                                                        name="rrn" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="student_name">Student Full Name</label>
                                                    <input type="text" readonly placeholder="Enter Student Name"
                                                           name="student_name" class="form-control"
                                                           value="{{ $apiData['fullname'] ?? '' }} {{ $apiData['surname'] ?? '' }}">
                                                    @error('student_name')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                
                                                
                                                <!-- Add more form fields as needed -->

                                                
                                                <div class="form-group">
                                                    <label for="policy_name">Policy Name</label>
                                                    <input type="text" readonly placeholder="Enter Policy Name"
                                                           name="semester" class="form-control"
                                                           value="{{ $policy['policyname'] ?? '' }}">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="policy_number">Policy Number</label>
                                                    <input type="text" readonly placeholder="Enter Policy Number"
                                                           name="reg_number" class="form-control"
                                                           value="{{ $policyNumber ?? '' }}">
                                                </div>
                                
                                                <div class="form-group">
                                                    <label for="message">Message</label>
                                                    <input type="text" readonly placeholder="Message"
                                                           name="message" class="form-control"
                                                           value="{{ $message ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="amount">Amount in Figures</label>
                                                    <input type="number" placeholder="200" name="amount"
                                                        class="form-control" value="{{ old('amount') }}" required>
                                                    @error('amount')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror  
                                                </div>
                                                <div class="form-group">
                                                    <label for="amount">Depositor Phone Number </label>
                                                    <input type="number" placeholder="26377...."
                                                        name="customer_phone_number" class="form-control"
                                                        value="{{ old('customer_phone_number') }}" required>
                                                </div>

                                              

                                                <div class="form-group">
                                                    <label for="amount">Amount in Words</label>
                                                    <input type="text" placeholder="Amount in words"
                                                        name="amount_in_words" class="form-control" value="{{ old('amount_in_words') }}" required>
                                                    @error('amount_in_words')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <input type="hidden" name="school_id"
                                                    value="{{ $bankAccount->school->id }}">
                                                <input type="hidden" name="bank_account_id"
                                                    value="{{ $bankAccount->id }}">
                                                <div class="form-group">
                                                    <button id="searchAccountBtn" class="btn btn-success btn-block"
                                                        type="submit">Make Payment</button>
                                                </div>
                                                <div class="form-group">
                                                    <a href="/payment/create" class="btn btn-danger btn-block"
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
    <script>
        function toggleRRNField() {
            var paymentMethod = document.getElementById('payment_method').value;
            var rrnField = document.getElementById('rrn_field');

            if (paymentMethod === 'swipe') {
                rrnField.style.display = 'block'; // Show RRN field
            } else {
                rrnField.style.display = 'none'; // Hide RRN field
            }
        }
    
        // Initial call to set the initial state based on the default value of the payment method
        toggleRRNField();
    </script>
@endsection
