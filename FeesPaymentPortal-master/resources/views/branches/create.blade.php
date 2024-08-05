@extends('shared.main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Branch</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">School Section</a>
                    </li>
                    <li class="breadcrumb-item active">Create Branch</li>
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
                    <form method="post" action="/branch">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label required">{{ __('Branch Name') }}</label>
                                <input type="text" name="branch_name" class="form-control" id="branch_name"
                                    placeholder="Enter branch name" value="{{ old('branch_name') }}">
                                @error('branch_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label required">{{ __('Contact Email') }}</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter contact email" value="{{ old('email') }}">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label required">{{ __('Contact Phone Number') }}</label>
                                <input type="text" name="mobile_number" class="form-control" id="mobile_number"
                                    placeholder="Enter contact phone number" value="{{ old('mobile_number') }}">
                                @error('mobile_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="branch_address">Address</label>
                                <textarea name="branch_address" class="form-control"
                                    id="branch_address">{{ old('branch_address') }}</textarea>
                                @error('branch_address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
@extends('shared.main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Branch</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">School Section</a>
                    </li>
                    <li class="breadcrumb-item active">Create Branch</li>
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
                    <form method="post" action="/branch">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label required">{{ __('Branch Name') }}</label>
                                <input type="text" name="branch_name" class="form-control" id="branch_name"
                                    placeholder="Enter branch name" value="{{ old('branch_name') }}">
                                @error('branch_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label required">{{ __('Contact Email') }}</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter contact email" value="{{ old('email') }}">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label required">{{ __('Contact Phone Number') }}</label>
                                <input type="text" name="mobile_number" class="form-control" id="mobile_number"
                                    placeholder="Enter contact phone number" value="{{ old('mobile_number') }}">
                                @error('mobile_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="branch_address">Address</label>
                                <textarea name="branch_address" class="form-control"
                                    id="branch_address">{{ old('branch_address') }}</textarea>
                                @error('branch_address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
@extends('shared.main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Branch</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">School Section</a>
                    </li>
                    <li class="breadcrumb-item active">Create Branch</li>
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
                    <form method="post" action="/branch">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label required">{{ __('Branch Name') }}</label>
                                <input type="text" name="branch_name" class="form-control" id="branch_name"
                                    placeholder="Enter branch name" value="{{ old('branch_name') }}">
                                @error('branch_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label required">{{ __('Contact Email') }}</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter contact email" value="{{ old('email') }}">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label required">{{ __('Contact Phone Number') }}</label>
                                <input type="text" name="mobile_number" class="form-control" id="mobile_number"
                                    placeholder="Enter contact phone number" value="{{ old('mobile_number') }}">
                                @error('mobile_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="branch_address">Address</label>
                                <textarea name="branch_address" class="form-control"
                                    id="branch_address">{{ old('branch_address') }}</textarea>
                                @error('branch_address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
