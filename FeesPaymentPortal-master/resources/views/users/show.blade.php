@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Show User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">User Section</a>
                        </li>
                        <li class="breadcrumb-item active">Show User</li>
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
                            <h3 class="card-title">View Fields in the Form Below</h3>
                        </div>
                       
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ethics User Name</label>
                                    <input readonly type="text" value="{{$user->ethics_user}}" name="ethics_user" required class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input readonly type="text" value="{{$user->first_name}}" name="first_name"required class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Last Email</label>
                                    <input readonly type="text" value="{{$user->last_name}}" name="last_name"required class="form-control"  >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contact Email </label>
                                    <input readonly type="email" value="{{$user->email}}" name="email" class="form-control"required id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Address</label>
                                    <textarea readonly name="branch_address" class="form-control" required>
                                       {{ $user->branch->branch_address}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="branch">User Type</label>
                                    <select readonly  class="form-control " name="type" value="{{$user->type}}" required>
                                        <option>Select User type</option>
                                        @foreach(\App\Enum\UserType::cases() as $userType)
                                            <option value="{{$userType->value}}" >{{$userType->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="/user" type="buttton" class="btn btn-primary">Back</a>
                            </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
