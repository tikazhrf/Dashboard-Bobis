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
                                    <td>{{ $row->buses->code_bus }}</td>
                                    <td>{{ $row->rutes->origin->bus_stops }}</td>
                                    <td>{{ $row->rutes->destination->bus_stops }}</td>
                                    <td>{{ $row->start_at }}</td>
                                    <td>{{ $row->end_at }}</td>
                                    <td>
                                        @foreach ($row->operation_day as $name)
                                            {{ $name }},
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('tampiljadwal', $row->id) }}"
                                            class="btn btn-warning rounded-circle fa fa-pencil-alt"></a>
                                        <a href="#" class="btn btn-danger rounded-circle fa fa-trash delete"
                                            onclick="event.preventDefault(); showConfirmationModal({{ $row->id }});"></a>

                                        <form id="delete-form-{{ $row->id }}"
                                            action="{{ route('deletejadwal', $row->id) }}" method="POST"
                                            style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            {{-- <div class="card-footer text-right">
                <nav class="d-inline-block">
                    <ul class="pagination mb-0">
                        {{ $data->links() }}
                    </ul>
                </nav>
            </div> --}}
        </div>
    </div>
@endsection

@section('script')
    <script>
        function showConfirmationModal(id) {
            Swal.fire({
                title: "Konfirmasi Penghapusan",
                text: "Anda yakin ingin menghapus item ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        @if (Session::has('success3'))
            toastr.success("{{ Session::get('success3') }}")
        @endif
    </script>
@endsection
