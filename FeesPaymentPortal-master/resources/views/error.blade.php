<!-- resources/views/error.blade.php -->
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

                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Error!</h4>
                            <p>Status Code: {{ $statusCode }}</p>
                            <p>Response Code: {{ $responseCode }}</p>
                            <p>Exception: {{ $exception }}</p>
                            <p>Message: {{ $message }}</p>
                        </div>

                        <script>
                            // Automatically redirect back to the form after 3 seconds
                            setTimeout(function () {
                                window.location.href = "/link-to-eco-cash";
                            }, 3000); // Adjust the delay (in milliseconds) as needed
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
