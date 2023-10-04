@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Customer Section</a>
                        </li>
                        <li class="breadcrumb-item active">Create Customer</li>
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
                            <h3 class="card-title">Fill in the Form Below To Create Customer</h3>
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
                        <form method="POST" action="{{ route('customer.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="control-label required">{{ __('First Name') }}</label>
                                    <input type="text" name="first_name" class="form-control"
                                        placeholder="Enter First Name" value="{{ old('first_name') }}" required>
                                    @error('school_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Surname') }}</label>
                                    <input type="text" name="surname" class="form-control"
                                        placeholder="Enter Surname" value="{{ old('surname') }}" required>
                                    @error('surname')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">{{ __('ID Number') }}</label>
                                    <input type="text" name="id_number" class="form-control"
                                        placeholder="Enter ID Number" value="{{ old('id_number') }}" required>
                                    @error('id_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Date Of Birth') }}</label>
                                    <input type="date" name="date_of_birth" class="form-control"
                                        placeholder="Enter Date Of Birth" value="{{ old('date_of_birth') }}" required>
                                    @error('date_of_birth')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Phone Number') }}</label>
                                    <input type="number" name="phone_number" class="form-control"
                                        placeholder="263775021912" value="{{ old('phone_number') }}" required>
                                    @error('phone_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                              
                                <div class="form-group">
                                    <label class="control-label required">{{ __('House Number') }}</label>
                                    <input type="text" name="house_number" class="form-control"
                                        placeholder="1090 Mukwana Ave" value="{{ old('house_number') }}" required>
                                    @error('house_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label required">{{ __('Area') }}</label>
                                    <input type="text" name="area" class="form-control"
                                        placeholder="Enter Area" value="{{ old('area') }}" required>
                                    @error('area')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label required">{{ __('City') }}</label>
                                    <input type="text" name="city" class="form-control"
                                        placeholder="Enter City" value="{{ old('city') }}" required>
                                    @error('city')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Create Customer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
