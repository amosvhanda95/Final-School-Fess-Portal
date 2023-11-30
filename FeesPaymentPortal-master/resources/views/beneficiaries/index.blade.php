@extends('shared.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Beneficiaries</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Beneficiary</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4"><h3 class="card-title">Available Beneficiary</h3></div>
                                <div class="col-md-8">
                                    <a href="/beneficiary/create" class="btn btn-primary" style="float: right">Add Beneficiary</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>rec_first_name</th>
                                            <th>rec_surname</th>
                                            <th>recipient_account_uri</th>
                                            <th>country</th>
                                            <th>customer_id</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($customer) && $customer->count())
                                            @foreach($customer as $key => $value)
                                                <tr>
                                                    <td>{{ ($customer->currentpage()-1) * $customer->perpage() + $key + 1 }}</td>
                                                    <td>{{ $value->rec_first_name }}</td>
                                                    <td>{{ $value->rec_surname }}</td>
                                                    <td>{{ $value->recipient_account_uri }}</td>
                                                    <td>{{ $value->fxrate->country }}</td>
                                                    <td>{{ $value->customer_id }}</td>
                                                    <td class="project-actions text-center">
                                                        <div class="btn-group">
                                                            <a class="btn btn-primary btn-sm" href="/beneficiary/{{$value->id}}">
                                                                <i class="fas fas-folder"></i>
                                                                View
                                                            </a>
                                                            <a class="btn btn-info btn-sm" href="/beneficiary/{{$value->id}}/edit">
                                                                <i class="fas fas-pencil-alt"></i>
                                                                Edit
                                                            </a>
                                                           
                                                        </div>
                                                    </td>
                                                    
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7">There are no data.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            
                            {!! $customer->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
