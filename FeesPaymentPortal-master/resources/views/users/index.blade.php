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
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Branch</th>
                                    <th>User Type</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($data) && $data->count())
                                    @foreach($data as $key => $value)
                                        <tr style="background-color: {{ $loop->index % 2 == 0 ? 'lightgray' : 'orange' }}">
                                            <td>  {{ ($data->currentpage()-1) * $data->perpage() + $key + 1 }}
                                            </td>
                                            <td>{{ $value->first_name }}</td>
                                            <td>{{ $value->last_name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->branch->branch_name }}</td>
                                            <td>

                                                @if ($value->type == 1)
                                                SysAdmin
                                            @elseif ($value->type == 2)
                                            SupportAdmin
                                            @elseif ($value->type == 3)
                                            Teller
                                            @elseif ($value->type == 4)
                                            ChiefTeller
                                            @endif

                                            </td>
                                            {{-- <td class="project-actions text-center">
                                                <a class="btn btn-primary btn-sm" href="/edit_user/{{$value->id}}}">
                                                    <i class="fas fas-folder"></i>
                                                    View
                                                </a>
                                                <a class="btn btn-info btn-sm" href="/user/{{$value->id}}}/edit">
                                                    <i class="fas fas-pencil-alt"></i>
                                                    Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" href="#">
                                                    <i class="fas fas-trash"></i>
                                                    Delete
                                                </a>
                                            </td> --}}
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
