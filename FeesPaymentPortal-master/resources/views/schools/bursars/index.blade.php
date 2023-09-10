@extends('shared.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>School Bursars</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Schools Bursars</li>
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
                                <div class="col-md-4"><h3 class="card-title">Available Schools Bursars</h3></div>
                                <div class="col-md-8">
                                    <a href="/bursar" class="btn btn-primary" style="float: right">Add School Bursar</a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Bursar Full Name</th>
                                    <th>School Name</th>
                                    <th>Mobile Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($data) && $data->count())
                                    @foreach($data as $key => $value)
                                        <tr>
                                            <td>  {{ ($data->currentpage()-1) * $data->perpage() + $key + 1 }}
                                            </td>
                                            <td>{{ $value->full_name }}</td>
                                            <td>{{ $value->school->school_name }}</td>
                                            <td>{{ $value->mobile_number }}</td>
                                            <td>@if ($value->status == 1)
                                                Active
                                            @else
                                                Inactive
                                            @endif</td>
                                            <td class="project-actions text-center">
                                                <a class="btn btn-primary btn-sm" href="/bursar/{{$value->id}}}">
                                                    <i class="fas fas-folder"></i>
                                                    View
                                                </a>
                                                <a class="btn btn-info btn-sm" href="/bursar/{{$value->id}}}/edit">
                                                    <i class="fas fas-pencil-alt"></i>
                                                    Edit
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
