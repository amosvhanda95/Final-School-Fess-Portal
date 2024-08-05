@extends('shared.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Crossboader-payment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/crossboarder">Crossboader-payment </a></li>
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
    
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    
                        {{ session('error') }}
                    </div>
               
            @endif
        </div>
                           

                     
                        <div class="card-body">
                            <table id="myuserDataTable" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>transaction_reference</th>
                                    <th>status</th>
                                    <th>principal_amount</th>
                                    <th> currency</th>
                                    <th>sender_account_uri</th>
                                    <th>recipient_account_uri</th>
                                    <th>fx_rate</th>
                                  
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
                                        <tr style="background-color: {{ $loop->index % 2 == 0 ? 'lightgray' : 'white' }}">
                                            <td>  {{ ($data->currentpage()-1) * $data->perpage() + $key + 1 }}
                                            </td>
                                            <td>{{ $value->transaction_reference }}</td>
                                            <td>{{ $value->status }}</td>
                                            <td>{{ $value->principal_amount }}</td>#
                                            <td>{{ $value->currency}} </td>
                                            <td>{{ $value->sender_account_uri }}</td>
                                            <td>{{ $value->recipient_account_uri}}</td>
                                            <td>{{ $value->fx_rate}}</td>
                                           
                                            <td class="project-actions text-center">
                                         
                                                <a class="btn btn-primary btn-sm"  href="{{ route('crossboader-payment.show', $value->id) }}">
                                                    <i class="fas fas-folder"></i>
                                                    View
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
