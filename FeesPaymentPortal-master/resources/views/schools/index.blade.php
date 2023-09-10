@extends('shared.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Schools</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">School Section</a></li>
                        <li class="breadcrumb-item active">View Registered Schools</li>
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
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="card-title">Available Schools</h3>
                                </div>
                                <div class="col-md-8">
                                    <a href="/school/create" class="btn btn-primary" style="float: right">Add School</a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>School Name</th>
                                        <th>School Type</th>
                                        <th>Contact Email</th>
                                        <th>Contact Phonenumber</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($data) && $data->count())
                                        @foreach ($data as $key => $value)
                                            <tr>
                                                <td> {{ ($data->currentpage() - 1) * $data->perpage() + $key + 1 }}
                                                </td>
                                                <td>{{ $value->school_name }}</td>
                                                <td>{{ $value->school_type }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->mobile_number }}</td>
                                                <td>@if ($value->status === 1)
                                                    Active
                                                @else
                                                    Inactive
                                                @endif</td>
                                                <td class="project-actions text-center">
                                                    <a class="btn btn-primary btn-sm"
                                                        href="/school_details/{{ $value->id }}">
                                                        <i class="fas fas-folder"></i>
                                                        View
                                                    </a>
                                                    <a class="btn btn-info btn-sm" href="/school/{{ $value->id }}/edit">
                                                        <i class="fas fas-pencil-alt"></i>
                                                        Edit
                                                    </a>

                                                    @if (!$value->is_foreign_key)
                                                        <form class="d-inline" action="school/{{ $value->id }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                        </form>
                                                    @else
                                                        
                                                    @endif
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
