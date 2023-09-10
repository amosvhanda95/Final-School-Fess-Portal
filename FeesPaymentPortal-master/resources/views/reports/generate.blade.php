<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
</head>
<body>
<div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
        Teller/ Agent <hr>
        <address>
            <strong>Full Name : {{request()->user()->first_name . ' '. request()->user()->last_name}}</strong><br>
            <strong>Email : {{request()->user()->email}}</strong><br>
        </address>
    </div>
    <div class="col-sm-4 invoice-col">
        Branch Details <hr>
        <b>Branch Name: </b> {{ $payment->branch->branch_name }}<br>
        <b>Branch Address: </b> {{ $payment->branch->branch_address }}<br>
        <b>Branch Email: </b> {{ $payment->branch->email }}<br>
        <b>Branch Phonenumber: </b> {{ $payment->branch->mobile_number }}<br>
    </div>

    <div class="col-sm-4 invoice-col">
        Payment Details<hr>
        <address>
                                        
            <strong>Student Name :</strong> {{ $payment->student_name }} <br>
            <strong>Student Reg number # :</strong> {{ $payment->reg_number }}<br>
            <strong>School Name : </strong>{{ $payment->school->school_name }}<br>
            <strong>Bank Account Number :</strong> {{ $payment->bankAccount->account_number }}<br>
            <strong>Customer Mobile Number : </strong>{{ $payment->customer_phone_number }}<br>
            <strong>Amount  : </strong>{{ $payment->amount }} <br>
            <strong>Currency :</strong> {{ $payment->currency_value }} <br>
            <strong>Class  :</strong> {{ $payment->class }} <br>
            <strong>Term  : </strong>{{ $payment->term }} <br>
            <strong>Semester  : </strong>{{ $payment->semester }} <br>
            <strong>Purpose  : </strong>{{ $payment->purpose }} <br>
            
        </address>
    </div>
    <div class="col-sm-4 invoice-col">
        Deposit Details<hr>
        <address>
                                        
            <strong>Depositor Name : </strong>{{ $payment->depositor_name }}<br>
            <strong> Mobile Number: </strong>{{ $payment->customer_phone_number }}<br>
            
            
        </address>
    </div>
    

</div>
</body>

</html>