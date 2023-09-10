@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">User Section</a>
                        </li>
                        <li class="breadcrumb-item active">Update User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Fields in the Form Below</h3>
                        </div>
                        <form method="post" action="/edit_branch/{{ $user->id }}/edit">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input type="text" value="{{$user->first_name}}" name="first_name" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Last Email</label>
                                    <input type="text" value="{{$user->last_name}}" name="last_name" class="form-control"  >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contact Number</label>
                                    <input type="number" value="{{$user->email}}" name="mobile_number" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Address</label>
                                    <textarea name="branch_address" class="form-control">
                                       {{ $branch->branch_address}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Branch</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
