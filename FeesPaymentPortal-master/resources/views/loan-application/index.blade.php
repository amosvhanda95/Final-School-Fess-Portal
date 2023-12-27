@extends('shared.main')
@section('content')
    <h2>Application History</h2>
    <ul>
        @foreach($loanApplications as $loanApplication)
            <li>{{ $loanApplication->applicant_name }} - {{ $loanApplication->status }}</li>
        @endforeach
    </ul>
@endsection
