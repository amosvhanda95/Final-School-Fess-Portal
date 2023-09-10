@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create School</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">School Section</a>
                        </li>
                        <li class="breadcrumb-item active">Create School</li>
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
                            <h3 class="card-title">Fill in the Form Below To Create School</h3>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="/school">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="control-label required">{{ __('School Name') }}</label>
                                    <input type="text" name="school_name" class="form-control"
                                        placeholder="Enter School Name" value="{{ old('school_name') }}" required>
                                    @error('school_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="branch" required>School Type</label>
                                    <select name="school_type" class="form-control" required>
                                        <option>Select Type</option>
                                        <option value="university" {{ old('school_type') === 'university' ? 'selected' : '' }}>University / College</option>
                                        <option value="high_school"{{ old('school_type') === 'high_school' ? 'selected' : '' }}>Primary / Secondary</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">{{ __('Contact Email') }}</label>
                                    <input type="email" name="email" class="form-control" 
                                        placeholder="Enter Email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">{{ __('Contact Mobile Number') }}</label>
                                    <input type="text" name="mobile_number" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter Mobile Number" value="{{ old('mobile_number') }}"  required>
                                        @error('mobile_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="true" {{ old('status') === 'true' ? 'selected' : '' }}>Active</option>
                                        <option value="false" {{ old('status') === 'false' ? 'selected' : '' }}>Disable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
