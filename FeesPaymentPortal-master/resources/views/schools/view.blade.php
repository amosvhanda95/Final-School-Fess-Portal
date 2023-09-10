@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $school->school_name }} Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">School Section</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $school->school_name }} Details</li>
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
                            <h3 class="card-title">{{ $school->school_name }} Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('School Name') }}</label>
                                <p>{{ $school->school_name }}</p>
                            </div>

                            <div class="form-group">
                                <label>{{ __('School Type') }}</label>
                                <p>{{ $school->school_type }}</p>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Contact Email') }}</label>
                                <p>{{ $school->email }}</p>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Contact Mobile Number') }}</label>
                                <p>{{ $school->mobile_number }}</p>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <p>{{ $school->status ? 'Active' : 'Inactive' }}</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="/school" type="buttton" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
