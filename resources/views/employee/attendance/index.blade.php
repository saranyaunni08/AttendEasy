@extends('layouts.app')        

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">List Attendance</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('employee.index') }}">Employee Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            List Attendance
                        </li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title text-primary text-center">
                                Search attendance using date range
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <form action="{{ route('employee.attendance.index') }}" class="row" method="POST">
                                    @csrf
                                    <div class="col-sm-9 mb-2">
                                        <div class="input-group">
                                            <input type="text" name="date_range" placeholder="Start Date" class="form-control"
                                            id="date_range"
                                            >
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-5 mb-2">
                                        <div class="input-group">
                                            <input type="text" name="end_date" placeholder="End Date" class="form-control">
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-3 mb-2">
                                        <div class="input-group">
                                            <input type="submit" name="" class="btn btn-primary" value="Submit">
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg mx-auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title text-center">
                                Attendances
                                @if ($filter)
                                    of a range
                                @endif
                            </div>
                            
                        </div>
                        <div class="card-body">
                            @if ($attendances->count())
                            <table class="table table-bordered table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Entry Time</th>
                                        <th>Entry Location</th>
                                        <th>Exit Time</th>
                                        <th>Exit Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($attendances as $index => $attendance)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        @if ($attendance->registered == 'yes')
                                        <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                        <td><h5 class="text-center"><span class="badge badge-pill badge-success">Present</span> </h5></td>
                                        <td>{{ $attendance->created_at->format('H:i:s') }}</td>
                                        <td>{{ $attendance->entry_location }}</td>
                                        <td>{{ $attendance->updated_at->format('H:i:s') }}</td>
                                        <td>{{ $attendance->exit_location }}</td>
                                        @elseif($attendance->registered == 'no')
                                        <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                        <td><h5 class="text-center"><span class="badge badge-pill badge-danger">Absent</span> </h5></td>
                                        <td class="text-center">No records</td>
                                        <td class="text-center">No records</td>
                                        <td class="text-center">No records</td>
                                        <td class="text-center">No records</td>
                                        @elseif($attendance->registered == 'sun')
                                        <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                        <td><h5 class="text-center"><span class="badge badge-pill badge-info">Sunday</span> </h5></td>
                                        <td class="text-center">No records</td>
                                        <td class="text-center">No records</td>
                                        <td class="text-center">No records</td>
                                        <td class="text-center">No records</td>
                                        @else
                                        <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                        <td><h5 class="text-center"><span class="badge badge-pill badge-warning">Half Day</span> </h5></td>
                                        <td>{{ $attendance->created_at->format('H:i:s') }}</td>
                                        <td>{{ $attendance->entry_location }}</td>
                                        <td>No entry</td>
                                        <td>No entry</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="alert alert-info text-center" style="width:50%; margin: 0 auto">
                                <h4>No Records Available</h4>
                            </div>
                            @endif
                            
                        </div>
                    </div>
                    <!-- general form elements -->
                    
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
@section('extra-js')

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive:true,
            autoWidth: false,
        });
        $('#date_range').daterangepicker({
            "maxDate": new Date(),
            "locale": {
                "format": "DD-MM-YYYY",
            }
        })
    });
</script>
@endsection