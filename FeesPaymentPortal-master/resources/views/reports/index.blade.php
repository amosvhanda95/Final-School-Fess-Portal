

@extends('shared.main')
@section('content')
<style>
   
    .header {
     display: flex;
     justify-content: space-between;
     align-items: center;
     padding: 10px 20px; /* Adjust padding as needed */
     
 }
 .logo img {
     max-width: 140px; /* Adjust logo width as needed */
     height: auto;
 }
 
 .details {
     text-align: right;
 }
 
 h1 {
     font-size: 24px;
     margin: 0;
 }
 
 p {
     margin: 5px 0;
 }
 .horizontal-line {
     border-bottom: 1px solid #000; /* You can adjust the thickness and color */
 }
 </style>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Schools Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">School Report Section</a></li>
                        <li class="breadcrumb-item active">View  Schools Reports</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-warning bg-secondary  header">
                        <div class="logo">
                        <img src="{{ asset('assets/img/logo.png') }}" clas alt="Posb Logo"   height: auto;">
                        <h1 style="color: orange;">FEES PAYMENT </h1>
                        </div>
                        <div class="details">
                            <h1>POSB HEAD OFFICE</h1>
                            <p>6th Floor, Causeway Building Cnr 3rd Street and, Central Ave</p>
                            <p>Harare Zimbabwe</p>
                            <p>+263 242 252595/6</p> <br>
                            <h1 style="color: orange;">FEES  PAYMENT REPORT</h1>

                            
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                
                                <div class="col-md-12 " style="text-align: center" >
                                    <h3  style="text-align: center">Payment Reports  of  {{ $selectedSchoolName }}</h3> <br>
                                    <p style="text-align: center">{{  $start_date }} - {{$end_date  }}</p>
                                </div>

                               
                                
                                
                                    <div id="reportForm" class="col-md-12">
                                        <form method="post" action="/reports/get">
                                            @csrf
                                            <label for="start_date">Start Date:</label>
                                            <input type="date" id="start_date" name="start_date" 
                                                   value="{{ old('start_date') }}">
                                        
                                            <label for="end_date">End Date:</label>
                                            <input type="date" id="end_date" name="end_date" 
                                                   value="{{ old('end_date') }}"> 
                                        
                                            <label for="school">Select School:</label>
                                            <select name="school">
                                                @foreach ($schools as $id => $schoolName)
                                                    <option value="{{ $id }}"
                                                        {{ old('school') == $id ? 'selected' : '' }}> <!-- Use old() to populate selected -->
                                                        {{ $schoolName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        <button type="submit" class="btn btn-primary" style="float: right">Submit</button>
                                        
                                    </div>
                                </form>
                                
                            </div>

                        </div>
                        <div class="card-body">
                           
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>



                                        <th>Student Name</th>
                                        <th>Student Class</th>
                                        <th>Student Reg Number</th>
                                        <th class="hidden-xs">Amount Paid</th>
                                        <th class="hidden-480">Date Paid</th>
                                        <th class="hidden-480">Paid By</th>
                                        <th>School Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                                <tr>
                                                    <td>
                                                        {{ $payment->student_name }}
                                                    </td>
                                                    <td>
                                                        {{ $payment->class }}
                                                    </td>
                                                    <td>
                                                        {{ $payment->reg_number }}
                                                    </td>
                                                    <td class="hidden-xs">
                                                        {{ $payment->amount }} {{ $payment->currency_value }}
                                                    </td>

                                                    <td>{{ $payment->paid_at}}</td>
                                                    <td>{{ $payment->depositor_name}}</td>
                                                    <td>{{ $payment->school->school_name }}</td>
                                                </tr>
                                            @endforeach
                                </tbody>
                            </table>
                            {{-- {!! $data->links('pagination::bootstrap-4') !!} --}}
                            <div class="form-group">
                                <label>Total Paid :{{$totalPaymentUSD}} USD</label>
                            </div>
                            <div class="form-group">
                                <label>Total Paid  :{{$totalPaymentZWL}} ZWL</label>
                            </div>
                           
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <a href="javascript:void(0);" onclick="printInvoice()" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
        </div>
    </section>
@endsection

<script>
    function printInvoice() {
        // Hide the form
        var reportForm = document.getElementById('reportForm');
        reportForm.style.display = 'none';

        // Trigger the print dialog
        window.print();

        // Show the form again after printing (optional)
        reportForm.style.display = 'block';
    }
</script>


