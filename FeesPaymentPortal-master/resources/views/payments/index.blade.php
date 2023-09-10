@extends('shared.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Payments History</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4"><h3 class="card-title">Payments History</h3></div>
                                <div class="col-md-8">
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date time</th>
                                    <th>School Name</th>
                                   
                                    <th>Student Name</th>
                                    
                                    <th>Amount</th>
                                    <th>Class </th>
                                    <th>Reg Number</th>
                                    <th> Status </th>
                                    <th> Refference Number </th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($data) && $data->count())
                                    @foreach($data as $key => $value)
                                        <tr style="background-color: {{ $loop->index % 2 == 0 ? 'lightgray' : 'primary' }}">
                                            <td>  {{ ($data->currentpage()-1) * $data->perpage() + $key + 1 }}
                                            </td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>{{ $value->school->school_name }}</td>
                                            
                                            <td>{{ $value->student_name }}</td>
                                            <td>{{ $value->currency_value }} {{ $value->amount }}</td>
                                            
                                            <td>{{ $value->class }}</td>
                                            <td>{{ $value->reg_number }}</td>
                                            <td>{{ $value->currency }}</td>
                                            <td>{{ $value->payment_status }}</td>
                                            {{-- <td>{{ $value->id }}</td> --}}
                                            <td class="project-actions text-center">
                                                <a class="btn btn-info btn-sm" href="payment/confirmed/{{$value->id}}">
                                                    <i class="fas fas-folder"></i>
                                                    View Payment
                                                </a>
                                                {{-- <a class="btn btn-primary btn-sm" href="/branch/{{$value->id}}/edit">
                                                    <i class="fas fas-pencil-alt"></i>
                                                    Send Email
                                                </a>
                                                <a class="btn btn-danger btn-sm" href="#">
                                                    <i class="fas fas-trash"></i>
                                                    Delete
                                                </a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10">There are no data.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            {!! $data->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<script>
        $( document.ready , function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example1').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
    });
</script>
