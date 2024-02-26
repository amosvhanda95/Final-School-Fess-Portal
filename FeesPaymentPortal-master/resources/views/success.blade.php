<!-- resources/views/success.blade.php -->
@extends('shared.main')

@section('content')
    <div class="content-header">
        <!-- Header content as needed -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>

                <div class="col-md-6">
                    <div class="card-body">
                        <h3>Link To Eco Cash</h3>

                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Success!</h4>
                            <p>{{ $message }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
