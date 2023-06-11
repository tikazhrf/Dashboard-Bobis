@extends('app')

@section('content')
    <div class="section-header">
        <h1>Bus Stops</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Bobus Dashboard</a></div>
            <div class="breadcrumb-item"><a>Bus Stops</a></div>
        </div>
    </div>
    <div class="card-header-form">
        {{-- @if ($message = Session::get('success'))
<div class="alert alert-success">
{{ $message }}
</div>
@endif --}}
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Bus Stops</h4>
                    <div class="card-header-form">
                        <form>
                            <div class="input-group">
                                <form action="busstops" method="get">
                                    <input type="search" class="form-control" placeholder="Search" name="search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                    <a href="/tambahbusstops" class="btn btn-primary">Add Bus
                                        Stops</a>
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
                                <th>Bus Stops</th>
                                <th>Action</th>
                            </tr>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $index => $row)
                                <tr>
                                    <th scope="row">{{ $index + $data->firstItem() }}</th>
                                    <td>{{ $row->bus_stops }}</td>
                                    <td>
                                        <a href="/tampilbusstops/{{ $row->id }}"
                                            class="btn btn-warning rounded-circle fa fa-pencil-alt"></a>
                                        <a href="#" class="btn btn-danger rounded-circle fa fa-trash delete"
                                            onclick="event.preventDefault(); showConfirmationModal({{ $row->id }});"></a>

                                        <form id="delete-form-{{ $row->id }}"
                                            action="{{ route('deleteuser', $row->id) }}" method="POST"
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
                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            {{ $data->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
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

        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif
    </script>
@endsection
