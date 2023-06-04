@extends('app')

@section('content')
    <div class="section-header">
        <h1>Schedule</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Bobus Dashboard</a></div>
            <div class="breadcrumb-item">Schedule</div>
        </div>
    </div>
    <div class="card-header-form">
        {{-- @if ($message = Session::get('success'))
<div class="alert alert-success">
{{ $message }}
</div>
@endif --}}</div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Schedule</h4>
                    <div class="card-header-form">
                        <form>
                            <div class="input-group">
                                <form action="/jadwal" method="get">
                                    <input type="search" class="form-control" placeholder="Search" name="search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                    <a href="/tambahjadwal" class="btn btn-primary">Add
                                        Schedule</a>
                                    {{-- Session::get('halaman_url') --}}
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>#</th>
                                <th>Bus Code</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <th>Start at</th>
                                <th>End at</th>
                                <th>Operation Day</th>
                                <th>Action</th>
                            </tr>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $row)
                                <tr class="align-items-center">
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $row->code_bus }}</td>
                                    <td>{{ $row->jadwals->rutes->origin->bus_stops }}</td>
                                    <td>{{ $row->jadwals->rutes->destination->bus_stops }}</td>
                                    <td>{{ $row->jadwals->start_at }}</td>
                                    <td>{{ $row->jadwals->end_at }}</td>
                                    <td>
                                        @foreach ($row->jadwals->operation_day as $name)
                                            {{ $name }},
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="/tampiljadwal/{{ $row->id }}"
                                            class="btn btn-warning rounded-circle fa fa-pencil-alt"></a>
                                        <a href="#" class="btn btn-danger rounded-circle fa fa-trash delete"
                                            data-id="{{ $row->id }}" data-nama="{{ $row->code_bus }}"></a>
                                    </td>
                                </tr>
                            @endforeach
                    </div>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <nav class="d-inline-block">
                    <ul class="pagination mb-0">
                        {{ $data->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.delete').click(function() {
            var jadwalid = $(this).attr('data-id');
            var nama = $(this).attr('data-nama');
            swal({
                    title: "Are you sure?",
                    text: "You will delete Schedule with Bus Code " + nama + " ",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/deletejadwal/" + jadwalid + ""
                        swal("The Schedule has been successfully deleted!", {
                            icon: "success3",
                        });
                    } else {
                        swal({
                            text: " " + nama + " is not deleted!"
                        });
                    }
                });
        });

        @if (Session::has('success3'))
            toastr.success("{{ Session::get('success3') }}")
        @endif
    </script>
@endsection
