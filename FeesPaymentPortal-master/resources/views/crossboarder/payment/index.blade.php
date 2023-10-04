@extends('shared.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                                <div class="col-md-4"><h3 class="card-title">Available Users</h3></div>
                                <div class="col-md-8">
                                    <a href="/user/create" class="btn btn-primary" style="float: right">Add User</a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <table id="myuserDataTable" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Transaction_Reference</th>
                                    <th>Status</th>
                                    <th>id_from_API</th>
                                    <th>rec_first_name</th>
                                    <th>rec_surname</th>
                                    <th>sender_surname</th>
                                  
                                    {{-- '',
         '',
        '',
        '',
        '',
        'rec_house_number',
        'rec_area',
        'rec_city',
        'country',
        'customer_id',
        'amount', --}}
        
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($data) && $data->count())
                                    @foreach($data as $key => $value)
                                        <tr style="background-color: {{ $loop->index % 2 == 0 ? 'lightgray' : 'orange' }}">
                                            <td>  {{ ($data->currentpage()-1) * $data->perpage() + $key + 1 }}
                                            </td>
                                            <td>{{ $value->transaction_reference }}</td>
                                            <td>{{ $value->status }}</td>
                                            <td>{{ $value->id_from_API }}</td>
                                            <td>{{ $value->rec_first_name }}</td>
                                            <td>{{ $value->rec_surname}}</td>
                                            <td>{{ $value->customer->surname}}</td>
                                           
                                            <td class="project-actions text-center">
                                                <a class="btn btn-primary btn-sm" href="/crossboader-payment/{{$value->id}}}">
                                                    <i class="fas fas-folder"></i>
                                                    View
                                                </a>
                                                
                                                <a class="btn btn-danger btn-sm" href="#">
                                                    <i class="fas fas-trash"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10">There are no data.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            {!! $data->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection
