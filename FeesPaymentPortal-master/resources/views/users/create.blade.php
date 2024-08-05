@extends('shared.main')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initially hide the account_number field
            $('#account_number_field').hide();

            // On user_type change, toggle visibility of fields
            $('select[name="user_type"]').change(function () {
                var selectedUserType = $(this).val();

                // Check if user_type is 5
                if (selectedUserType == 5) {
                    $('#ethics_user_field').hide();
                    $('#account_number_field').show();
                } else {
                    $('#ethics_user_field').show();
                    $('#account_number_field').hide();
                }
            });
        });
    </script>
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
                                    <label for="branch">User Type</label>
                                    <select name="user_type" class="form-control">
                                        <option>Select User type</option>
                                        @foreach(\App\Enum\UserType::cases() as $userType)
                                            <option value="{{$userType->value}}">{{$userType->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="account_number_field">
                                    <label class="control-label required">{{ __('Account Number') }}</label>
                                    <input type="text" name="account_number" class="form-control" id="exampleInputEmail1"
                                           value="{{ old('account_number') }}" placeholder="Enter account number">
                                </div>
                                <div class="form-group" id="ethics_user_field">
                                    <label class="control-label required">{{ __('Ethics User Name') }}</label>
                                    <input type="text" name="ethics_user" class="form-control" id="exampleInputEmail1"
                                           value="{{ old('ethics_user') }}" placeholder="Enter ethic username">
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label required">{{ __('First Name') }}</label>
                                    <input type="text"  name="first_name" class="form-control" id="exampleInputEmail1"
                                    value="{{ old('first_name') }}" placeholder="Enter First Name">
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">{{ __('Last Name') }}</label>
                                    <input type="text"  name="last_name" class="form-control" id="exampleInputEmail1"
                                    value="{{ old('last_name') }}" placeholder="Enter Surname">
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
