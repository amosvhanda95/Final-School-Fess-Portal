<!-- resources/views/loan-application/create.blade.php -->
@extends('shared.main')

@section('content')
    <div class="content-header">
        <!-- Similar header code as in the customer creation form -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Fill in the Form Below To Apply for a Loan</h3>
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
                        <form method="POST" action="{{ route('loan-application.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="loan_type" class="control-label required">{{ __('Loan Type') }}</label>
                                    <select id="loan_type" class="form-control @error('loan_type') is-invalid @enderror" name="loan_type" required>
                                        <option disabled selected value="">Please select a loan type</option>
                                        @foreach($loanTypes as $type)
                                            <option value="{{ $type }}" {{ old('loan_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                    @error('loan_type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">{{ __('Loan Amount') }}</label>
                                    <input type="text" name="amount" class="form-control"
                                        placeholder="Enter Loan Amount" value="{{ old('amount') }}" required>
                                    @error('amount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">{{ __('Term (Months)') }}</label>
                                    <input type="number" name="term_months" class="form-control"
                                        placeholder="Enter Term (Months)" value="{{ old('term_months') }}" required>
                                    @error('term_months')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">{{ __('Interest Rate (%)') }}</label>
                                    <input type="number" name="interest_rate" class="form-control"
                                        placeholder="Enter Interest Rate" value="{{ old('interest_rate') }}" required>
                                    @error('interest_rate')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Add other loan application form fields as needed -->

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Apply for Loan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
