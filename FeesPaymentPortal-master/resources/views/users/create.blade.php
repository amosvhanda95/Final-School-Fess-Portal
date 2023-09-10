@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">User Section</a>
                        </li>
                        <li class="breadcrumb-item active">Create User</li>
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
                            <h3 class="card-title">Fill in the Form Below</h3>
                        </div>
                        @if ($errors->any()) <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach </ul>
                        </div>
                        @endif
                        <form method="post" action="/user">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Ethics User Name') }}</label>
                                    <input type="text"  name="first_name" class="form-control" id="exampleInputEmail1"
                                    value="{{ old('first_name') }}" placeholder="Enter ethic username">
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">{{ __('Full Name') }}</label>
                                    <input type="text"  name="last_name" class="form-control" id="exampleInputEmail1"
                                    value="{{ old('last_name') }}" placeholder="Enter full name">
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">{{ __('Email') }}</label>
                                    <input type="email"  name="email" class="form-control" id="exampleInputEmail1"
                                    value="{{ old('email') }}" placeholder="Enter first name">
                                </div>

                                <div class="form-group">
                                    <label for="branch" required>Branch</label>
                                    <select name="branch" class="form-control" value="{{ old('branch') }}" required>
                                        <option disabled selected>Select Branch</option>
                                        @foreach( \App\Models\Branch::all() as $branch)
                                            <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="branch">User Type</label>
                                    <select name="user_type" class="form-control">
                                        <option>Select User type</option>
                                        @foreach(\App\Enum\UserType::cases() as $userType)
                                            <option value="{{$userType->value}}">{{$userType->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
