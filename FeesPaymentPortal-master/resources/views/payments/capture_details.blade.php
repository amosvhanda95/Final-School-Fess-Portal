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
                        <div class="card-header">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>School Name</th>
                                            <th>School Account #</th>
                                            <th>Currency</th>
                                            <th>School Email</th>
                                            <th>School Phonenumber</th>
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
                        
                        
                        <form method="post" action="/payment/make_payment" id="quickForm">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        @if ($bankAccount->school->school_type == 'university')
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3>Please Fill in the following fields</h3>
                                                </div>
                                                <div class="card-body">
                                                    @if ($errors->any()) <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach </ul>
                                                    </div>
                                                    @endif
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
                                                        <input type="text" placeholder="Enter Student Name"
                                                            name="student_name" class="form-control"
                                                            value="{{ old('student_name') }}" required>
                                                        @error('student_name')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reg_number">Student Registration Number</label>
                                                        <input type="text" placeholder="R158678T"
                                                            name="reg_number" class="form-control" value="{{ old('reg_number') }}" required>
                                                            @error('reg_number')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
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
                                                        <label for="amount_in_words">Amount in Words</label>
                                                        <input type="text" placeholder="Amount in words"
                                                            name="amount_in_words" class="form-control" value="{{ old('amount_in_words') }}" required >
                                                            @error('amount_in_words')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                    {{-- <div class="form-group">
                                                        <label for="customer_phone_number">Customer Phone Number</label>
                                                        <input type="text" placeholder="263775021912"
                                                            name="customer_phone_number" class="form-control" value="{{ old('customer_phone_number') }}" required  >
                                                            @error('customer_phone_number')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Year</label>
                                                        <input type="text" value="2023" name="year"
                                                        value="{{ old('year') }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="semester">Semester</label>
                                                        <select name="semester" class="form-control" value="{{ old('semester') }}" required >
                                                            <option disabled selected>Select Semester</option>
                                                            <option value="1st Semester">1st Semester</option>
                                                            <option value="2nd Semester">2nd Semester</option>
                
                                                            @error('semester')

                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Purpose</label>
                                                        <input type="text" placeholder="Transaction Purpose"
                                                            name="purpose" class="form-control" value="{{ old('purpose') }}"required>
                                                    </div> --}}
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
                                        @else
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3>Please Fill in the following fields</h3>
                                                </div>
                                                <div class="card-body">
                                                    @if ($errors->any()) <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach </ul>
                                                    </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <label for="payment_method">Payment Method</label>
                                                        <select name="payment_method" id="payment_method" class="form-control" onchange="toggleRRNField()">
                                                            <option value="swipe">Swipe</option>
                                                            <option value="cash">Cash</option>
                                                        </select>
                                                    </div>
                                                   
                                                    <div class="form-group">
                                                        <label for="currency">Currency</label>
                                                        <select name="currency" id="currency" class="form-control" onchange="toggleRRNField()">
                                                            <option value="ZiG">ZiG</option>
                                                            <option value="USD">USD</option>
                                                            <!-- Add more currency options as needed -->
                                                        </select>
                                                    </div>
                                                   
                                                    
                                                    
                                                    <div class="form-group"id="rrn_field">
                                                        <label for="amount">Enter RRN </label>
                                                        <input type="number" id="rrn_field1" placeholder="7879677"
                                                            name="rrn" class="form-control">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="student_name">Student Full Name</label>
                                                        <input type="text" placeholder="Enter Student Name"
                                                            name="student_name" class="form-control" id="student_name"
                                                            value="{{ old('student_name') }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Amount in Figures</label>
                                                        <input type="number" placeholder="200"
                                                            name="amount" class="form-control"
                                                            value="{{ old('amount') }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Amount in Words</label>
                                                        <input type="text" placeholder="Amount in words"
                                                            name="amount_in_words" class="form-control"
                                                            value="{{ old('amount_in_words') }}" required>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="depositor_name">Depositor Name</label>
                                                        <input type="text" placeholder="MR Chirwa"
                                                            name="depositor_name" class="form-control"
                                                            value="{{ old('depositor_name') }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Depositor Phone Number </label>
                                                        <input type="number" placeholder="26377...."
                                                            name="customer_phone_number" class="form-control"
                                                            value="{{ old('customer_phone_number') }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Year</label>
                                                        <input type="text" value="2023" name="year"
                                                            class="form-control" value="{{ old('year') }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Form / Grade</label>
                                                        <input type="text" placeholder="4A / 4 SCIENCES"
                                                            name="class" class="form-control"
                                                            value="{{ old('class') }}"  required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Term</label>
                                                        <select name="term" class="form-control" value="{{ old('term') }}" required>
                                                            <option selected disabled>Select Term</option>
                                                            <option value="1">1st Term</option>
                                                            <option value="2">2nd Term</option>
                                                            <option value="3">3rd Term</option>
                                                        </select>
                                                    </div>
                                                    <input type="hidden" name="school_id"
                                                        value="{{ $bankAccount->school->id }}">
                                                    <input type="hidden" name="bank_account_id"
                                                        value="{{ $bankAccount->id }}">
                                                    <div class="form-group">
                                                        <label for="amount">Purpose</label>
                                                        <input type="text" placeholder="Transaction Purpose"
                                                            name="purpose" class="form-control" value="{{ old('purpose') }}" required>
                                                    </div>

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
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
