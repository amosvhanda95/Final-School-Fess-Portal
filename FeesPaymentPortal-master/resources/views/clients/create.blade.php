@extends('shared.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Clients</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Clients Section</a>
                        </li>
                        <li class="breadcrumb-item active">Create Clients</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>

                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>

                                <th>Client ID</th>
                                <td>User_ID</td>
                                <th>Client Name</th>
                                <th>Client Rredirect</th>
                                <th>Client Secrete</th>
                                


                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($clients) && $clients->count())
                                @foreach ($clients as $client)
                                    <tr>

                                        <td>{{ $client->id }}</td>
                                        <td>{{ $client->user_id }}</td>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->redirect }}</td>
                                        <td>{{ $client->secret }}</td>
                                        {{-- <td class="project-actions text-center">

                                            <a class="btn btn-info btn-sm" href="/branch//edit">
                                                <i class="fas fas-pencil-alt"></i>
                                                Edit
                                            </a>
                                            <form action="/oauth/clients/{{ $client->id }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fas-trash"></i> Delete
                                                </button>
                                            </form>
                                            
                                        </td> --}}
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">There are no data.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h3>Registered Clients</h3>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Fill in To Create Clients </h3>

                            </div>
                            <form method="post" action="/oauth/clients">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="control-label required">{{ __('Name') }}</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Enter client name">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label required">{{ __('Redirect Email') }}</label>
                                        <input type="text" name="redirect" class="form-control" id="redirect"
                                            placeholder="https://my-url.com/callback">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create Client</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
