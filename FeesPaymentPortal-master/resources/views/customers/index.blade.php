@extends('shared.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customers</li>
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
                                <div class="col-md-4"><h3 class="card-title">Available Customers</h3></div>
                                <div class="col-md-8">
                                    <a href="/customer/create" class="btn btn-primary" style="float: right">Add Customer</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>first_name</th>
                                            <th>id_number</th>
                                            <th>date_of_birth</th>
                                            <th>phone_number</th>
                                            <th>house_number</th>
                                            <th>area</th>
                                            <th>city</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($customer) && $customer->count())
                                            @foreach($customer as $key => $value)
                                                <tr>
                                                    <td>{{ ($customer->currentpage()-1) * $customer->perpage() + $key + 1 }}</td>
                                                    <td>{{ $value->first_name }}</td>
                                                    <td>{{ $value->id_number }}</td>
                                                    <td>{{ $value->date_of_birth }}</td>
                                                    <td>{{ $value->phone_number }}</td>
                                                    <td>{{ $value->house_number }}</td>
                                                    <td>{{ $value->area }}</td>
                                                    <td>{{ $value->city }}</td>
                                                    <td class="project-actions text-center">
                                                        <div class="btn-group">
                                                            <a class="btn btn-primary btn-sm" href="/customer/{{$value->id}}">
                                                                <i class="fas fas-folder"></i>
                                                                View
                                                            </a>
                                                            <a class="btn btn-info btn-sm" href="/customer/{{$value->id}}/edit">
                                                                <i class="fas fas-pencil-alt"></i>
                                                                Edit
                                                            </a>
                                                           
                                                        </div>
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
                            </div>
                            
                            {!! $customer->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
