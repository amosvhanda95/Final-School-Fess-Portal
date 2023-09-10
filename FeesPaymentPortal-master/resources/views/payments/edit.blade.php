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

                                        <td>
                                            {{ $bankAccount->school->email }}
                                        </td>
                                        <td>
                                            {{ $bankAccount->school->mobile_number }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form method="post" action="/edit_payment/{{ $bankAccount->id }}/edit" id="quickForm">
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

                                                    
                                                    <div class="form-group">
                                                        <label for="student_name">Student Full Name</label>
                                                        <input type="text" value="{{$bankAccount->student_name}}" placeholder="Enter Student Name"
                                                            name="student_name" class="form-control"
                                                            value="{{ old('student_name') }}" required>
                                                        @error('student_name')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="reg_number">Student Registration Number</label>
                                                        <input type="text" placeholder="Enter Student Reg number" value="{{$bankAccount->reg_number}}"
                                                            name="reg_number" class="form-control" value="{{ old('reg_number') }}" required>
                                                            @error('reg_number')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Amount in Figures</label>
                                                        <input type="number" placeholder="Amount in Figures" name="amount" value="{{$bankAccount->amount}}"
                                                            class="form-control" value="{{ old('amount') }}" required>
                                                            @error('amount')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror  
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Amount in Words</label>
                                                        <input type="text" placeholder="Amount in words"
                                                        value="{{$bankAccount->amount_in_words}}"
                                                            name="amount_in_words" class="form-control" value="{{ old('amount_in_words') }}" required >
                                                            @error('amount_in_words')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="depositor_name">Depositor Name</label>
                                                        <input type="text" placeholder="26377...." value="{{$bankAccount->depositor_name}}"
                                                            name="depositor_name" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Customer Phonenumber</label>
                                                        <input type="text" placeholder="Amount in words" value="{{$bankAccount->customer_phone_number}}"
                                                            name="customer_phone_number" class="form-control" value="{{ old('customer_phone_number') }}" required  >
                                                            @error('customer_phone_number')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Year</label>
                                                        <input type="text" value="2023" name="year"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Semester</label>
                                                        <select name="semester" class="form-control">
                                                            <option>Select Semester</option>
                                                            <option value="1st Semester">1st Semester</option>
                                                            <option value="2nd Semester">2nd Semester</option>
                                                            @error('semester')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Purpose</label>
                                                        <input type="text" placeholder="Transaction Purpose" value="{{$bankAccount->purpose}}"
                                                            name="purpose" class="form-control">
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
                                        @else
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3>Please Fill in the following fields</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="student_name">Student Name</label>
                                                        <input type="text" placeholder="Enter Student Name" value="{{$bankAccount->student_name}}"
                                                            name="student_name" class="form-control" id="student_name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Amount in Figures</label>
                                                        <input type="number" placeholder="Amount in Figures" value="{{$bankAccount->amount}}"
                                                            name="amount" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Amount in Words</label>
                                                        <input type="text" placeholder="Amount in words"
                                                            name="amount_in_words" class="form-control" value="{{$bankAccount->amount_in_words}}" required>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="depositor_name">Depositor Name</label>
                                                        <input type="text" placeholder="26377...."
                                                            name="depositor_name" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Depositor Phone Number </label>
                                                        <input type="number" placeholder="26377...."
                                                            name="customer_phone_number" class="form-control" value="{{$bankAccount->customer_phone_number}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Year</label>
                                                        <input type="text" value="2023" name="year"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Form / Grade</label>
                                                        <input type="text" placeholder="4A / 4 SCIENCES" value="{{$bankAccount->class}}"
                                                            name="class" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Term</label>
                                                        <select name="term" class="form-control" required>
                                                            <option>Select Term</option>
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
                                                        <input type="text" placeholder="Transaction Purpose" value="{{$bankAccount->purpose}}"
                                                            name="purpose" class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <button id="searchAccountBtn" class="btn btn-success btn-block"
                                                            type="submit">Make Payment</button>
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
    </section>
@endsection
