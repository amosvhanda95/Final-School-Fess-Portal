@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update School</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">School Section</a>
                        </li>
                        <li class="breadcrumb-item active">Update School</li>
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
                            <h3 class="card-title">Edit  in the Form Below To Update School</h3>
                        </div>
                        @if ($errors->any()) <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach </ul>
                        </div>
                        @endif
                        <form method="post" action="/edit_school/{{ $school->id }}/edit">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="control-label required">{{ __('School Name') }}</label>
                                    <input  value="{{$school->school_name}}"  type="text"  name="school_name" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <label for="branch" required>School Type</label>
                                    <select name="school_type" class="form-control" value="{{$school->school_type}}" required>
                                        <option value="{{$school->school_type}}">{{$school->school_type}}</option>
                                        <option value="university">University / College</option>
                                        <option value="high_school">Primary / Secondary</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">{{ __('Contact Email') }}</label>
                                    <input type="email" value="{{$school->email}}" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email">
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">{{ __('Contact Mobile Number') }}</label>
                                    <input type="text" value="{{$school->mobile_number}}" name="mobile_number" class="form-control" id="exampleInputEmail1">
                                </div>

                                <div class="form-group">
                                    <label for="branch" required>Status</label>
                                    <select name="status" class="form-control" value="{{$school->status}}" required>
                                        <option value="1">Active</option>
                                        <option value="0">Disable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
